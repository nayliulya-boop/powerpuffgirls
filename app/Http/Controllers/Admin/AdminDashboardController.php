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

        if (in_array($status, ['pending_approval', 'approved', 'upcoming', 'ongoing', 'completed', 'cancelled', 'rejected'], true)) {
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

        // Prioritize pending approval bookings first, then newest created bookings
        $statusOrder = "CASE status 
            WHEN 'pending_approval' THEN 1 
            WHEN 'approved' THEN 2 
            WHEN 'upcoming' THEN 3 
            WHEN 'ongoing' THEN 4 
            WHEN 'completed' THEN 5 
            WHEN 'rejected' THEN 6 
            WHEN 'cancelled' THEN 7 
            ELSE 8 END";

        $vacations = $vacationsQuery
            ->orderByRaw($statusOrder)
            ->orderBy('created_at', 'desc')
            ->get();

        $allVacations = Vacation::all();

        $totalBookings = $allVacations->count();
        $pendingApprovalCount = $allVacations->where('status', 'pending_approval')->count();
        $approvedCount = $allVacations->where('status', 'approved')->count();
        $upcomingCount = $allVacations->where('status', 'upcoming')->count();
        $ongoingCount = $allVacations->where('status', 'ongoing')->count();
        $completedCount = $allVacations->where('status', 'completed')->count();
        $rejectedCount = $allVacations->where('status', 'rejected')->count();
        $cancelledCount = $allVacations->where('status', 'cancelled')->count();
        $paidCount = $allVacations->where('payment_status', 'paid')->count();
        $totalRevenue = (float) $allVacations->where('payment_status', 'paid')->sum('price');

        $loginRoles = DB::table('login')
            ->whereNull('deleted_at')
            ->pluck('role', 'user_id');

        $customers = User::withCount('vacations')
            ->withSum([
                'vacations as total_spend' => function ($query): void {
                    $query->whereIn('status', ['upcoming', 'ongoing', 'completed']);
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
            'pendingApprovalCount' => $pendingApprovalCount,
            'approvedCount' => $approvedCount,
            'upcomingCount' => $upcomingCount,
            'ongoingCount' => $ongoingCount,
            'completedCount' => $completedCount,
            'rejectedCount' => $rejectedCount,
            'cancelledCount' => $cancelledCount,
            'paidCount' => $paidCount,
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
            'status' => ['required', 'string', 'in:pending_approval,approved,upcoming,ongoing,completed,cancelled,rejected'],
        ]);

        $vacation->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "Booking {$vacation->package_code} ({$vacation->destination}) status updated to ".ucfirst($validated['status']).'.');
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
