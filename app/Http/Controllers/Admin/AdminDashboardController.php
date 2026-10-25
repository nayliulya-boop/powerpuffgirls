<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Ensure the authenticated user has admin role.
     */
    private function isAdmin(User $user): bool
    {
        $role = DB::table('login')
            ->where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->value('role');

        return $role === 'admin';
    }

    /**
     * Display the Admin Executive Dashboard with agency-wide metrics, bookings, customers, and destinations.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if (! $this->isAdmin($user)) {
            return redirect()->route('customer.dashboard');
        }

        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $vacationsQuery = Vacation::with(['user', 'latestPayment']);

        if ($status === 'pending' || $status === 'pending_approval') {
            $vacationsQuery->whereIn('status', ['pending', 'pending_approval']);
        } elseif ($status === 'cancelled') {
            $vacationsQuery->whereIn('status', ['cancelled', 'rejected']);
        } elseif (in_array($status, ['approved', 'completed', 'upcoming', 'ongoing'], true)) {
            $vacationsQuery->where('status', $status);
        }

        if ($search !== '') {
            $vacationsQuery->where(function ($query) use ($search): void {
                $query->where('destination', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('package_code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search): void {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $statusOrder = "CASE status 
            WHEN 'pending_approval' THEN 1 
            WHEN 'pending' THEN 1 
            WHEN 'approved' THEN 2 
            WHEN 'upcoming' THEN 3 
            WHEN 'ongoing' THEN 4 
            WHEN 'completed' THEN 5 
            WHEN 'cancelled' THEN 6 
            WHEN 'rejected' THEN 6 
            ELSE 7 END";

        $vacations = $vacationsQuery
            ->orderByRaw($statusOrder)
            ->orderBy('start_date', 'desc')
            ->get();

        $allVacations = Vacation::all();

        $totalBookings = $allVacations->count();
        $pendingCount = $allVacations->whereIn('status', ['pending', 'pending_approval'])->count();
        $approvedCount = $allVacations->where('status', 'approved')->count();
        $completedCount = $allVacations->where('status', 'completed')->count();
        $cancelledCount = $allVacations->whereIn('status', ['cancelled', 'rejected'])->count();
        $upcomingCount = $allVacations->where('status', 'upcoming')->count();
        $ongoingCount = $allVacations->where('status', 'ongoing')->count();
        $totalRevenue = (float) $allVacations->whereIn('status', ['upcoming', 'ongoing', 'completed', 'approved'])->sum('price');

        $loginRoles = DB::table('login')
            ->whereNull('deleted_at')
            ->pluck('role', 'user_id');

        $customers = User::withCount('vacations')
            ->withSum([
                'vacations as total_spend' => function ($query): void {
                    $query->whereIn('status', ['upcoming', 'ongoing', 'completed', 'approved']);
                },
            ], 'price')
            ->orderBy('id')
            ->get()
            ->map(function (User $account) use ($loginRoles): User {
                $account->setAttribute('role', $loginRoles[$account->id] ?? 'customer');

                return $account;
            });

        $destinations = Destination::orderByDesc('is_featured')->orderBy('id')->get();

        $stats = [
            'totalRevenue' => $totalRevenue,
            'totalBookings' => $totalBookings,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'completedCount' => $completedCount,
            'rejectedCount' => $rejectedCount,
            'cancelledCount' => $cancelledCount,
            'upcomingCount' => $upcomingCount,
            'ongoingCount' => $ongoingCount,
            'totalCustomers' => $customers->where('role', 'customer')->count(),
            'totalDestinations' => $destinations->count(),
        ];

        return view('admin.dashboard', [
            'user' => $user,
            'vacations' => $vacations,
            'stats' => $stats,
            'status' => $status,
            'search' => $search,
            'customers' => $customers,
            'destinations' => $destinations,
        ]);
    }

    /**
     * Update the status of any customer vacation booking.
     */
    public function updateVacationStatus(Request $request, Vacation $vacation): RedirectResponse
    {
        if (! $this->isAdmin($request->user())) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:pending,pending_approval,approved,completed,cancelled,upcoming,ongoing'],
        ]);

        $newStatus = $validated['status'];
        if ($newStatus === 'pending') {
            $newStatus = 'pending_approval';
        }

        $updates = [
            'status' => $newStatus,
        ];

        if ($newStatus === 'approved') {
            $updates['reviewed_by'] = $request->user()->id;
            $updates['reviewed_at'] = now();
        }

        $vacation->update($updates);

        $statusText = match ($newStatus) {
            'pending_approval', 'pending' => 'Pending Approval',
            'approved' => 'Approved',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
            default => ucfirst($newStatus),
        };

        return redirect()->back()
            ->with('success', "Booking {$vacation->package_code} ({$vacation->destination}) status updated to {$statusText}.");
    }

    /**
     * Store a new luxury destination package in the catalog.
     */
    public function storeDestination(Request $request): RedirectResponse
    {
        if (! $this->isAdmin($request->user())) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:100'],
            'duration_days' => ['required', 'integer', 'min:1', 'max:60'],
            'price' => ['required', 'numeric', 'min:100'],
            'description' => ['required', 'string', 'max:1000'],
            'image_path' => ['nullable', 'url', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        Destination::create([
            'title' => $validated['title'],
            'location' => $validated['location'],
            'badge' => $validated['badge'] ?: 'Exclusive Sanctuary',
            'rating' => 4.95,
            'reviews_count' => random_int(45, 180),
            'duration_days' => $validated['duration_days'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_path' => $validated['image_path'] ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "New luxury destination '{$validated['title']}' has been published to the AzureVoyage catalog.");
    }

    /**
     * Remove a destination package from the catalog.
     */
    public function destroyDestination(Request $request, Destination $destination): RedirectResponse
    {
        if (! $this->isAdmin($request->user())) {
            abort(403, 'Unauthorized action.');
        }

        $title = $destination->title;
        $destination->delete();

        return redirect()->route('admin.dashboard')
            ->with('info', "Destination '{$title}' was removed from the catalog.");
    }
}
