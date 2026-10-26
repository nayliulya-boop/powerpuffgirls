<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Payment;
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
     * Display the Admin Executive Dashboard with agency-wide metrics, bookings, customers, payments, and packages.
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
            ->orderBy('created_at', 'desc')
            ->get();

        $allVacations = Vacation::all();

        $totalBookings = $allVacations->count();
        $pendingCount = $allVacations->whereIn('status', ['pending', 'pending_approval'])->count();
        $approvedCount = $allVacations->where('status', 'approved')->count();
        $completedCount = $allVacations->where('status', 'completed')->count();
        $rejectedCount = $allVacations->where('status', 'rejected')->count();
        $cancelledCount = $allVacations->whereIn('status', ['cancelled', 'rejected'])->count();
        $upcomingCount = $allVacations->where('status', 'upcoming')->count();
        $ongoingCount = $allVacations->where('status', 'ongoing')->count();

        // Payments records & statistics
        $payments = Payment::with(['vacation', 'user'])
            ->orderBy('paid_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $successfulPaymentsCount = $payments->where('status', 'completed')->count();
        $successfulPaymentsTotal = (float) $payments->where('status', 'completed')->sum('amount');
        $totalRevenue = $successfulPaymentsTotal > 0 ? $successfulPaymentsTotal : (float) $allVacations->whereIn('status', ['upcoming', 'ongoing', 'completed', 'approved'])->sum('price');

        // Customer Registry & history
        $loginRoles = DB::table('login')
            ->whereNull('deleted_at')
            ->pluck('role', 'user_id');

        $customersQuery = User::withCount('vacations')
            ->withSum([
                'vacations as total_spend' => function ($query): void {
                    $query->whereIn('status', ['upcoming', 'ongoing', 'completed', 'approved']);
                },
            ], 'price')
            ->orderBy('id');

        if ($status === 'all') {
            $customersQuery->with(['vacations' => function ($query): void {
                $query->with('latestPayment')->orderBy('created_at', 'desc');
            }]);
        }

        $customers = $customersQuery
            ->get()
            ->map(function (User $account) use ($loginRoles): User {
                $account->setAttribute('role', $loginRoles[$account->id] ?? 'customer');

                return $account;
            });

        // Destinations catalog
        $destinations = Destination::orderByDesc('is_featured')->orderBy('id', 'desc')->get();

        // Popular packages report (only generated on default overview to preserve status filter isolation)
        $popularPackages = $status === 'all' && $search === ''
            ? DB::table('vacations')
                ->select('destination', 'title', DB::raw('count(*) as booking_count'), DB::raw('sum(price) as total_revenue'))
                ->groupBy('destination', 'title')
                ->orderByDesc('booking_count')
                ->limit(5)
                ->get()
            : collect();

        $stats = [
            'totalRevenue' => $totalRevenue,
            'totalBookings' => $totalBookings,
            'successfulPaymentsCount' => $successfulPaymentsCount,
            'successfulPaymentsTotal' => $successfulPaymentsTotal,
            'pendingCount' => $pendingCount,
            'pendingApprovalCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'completedCount' => $completedCount,
            'rejectedCount' => $rejectedCount,
            'cancelledCount' => $cancelledCount,
            'upcomingCount' => $upcomingCount,
            'ongoingCount' => $ongoingCount,
            'totalCustomers' => $customers->where('role', 'customer')->count(),
            'totalDestinations' => $destinations->count(),
            'activeDestinations' => $destinations->where('is_active', true)->count(),
        ];

        return view('admin.dashboard', [
            'user' => $user,
            'vacations' => $vacations,
            'stats' => $stats,
            'status' => $status,
            'search' => $search,
            'customers' => $customers,
            'destinations' => $destinations,
            'payments' => $payments,
            'popularPackages' => $popularPackages,
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
            'capacity' => ['nullable', 'integer', 'min:1', 'max:100'],
            'amenities' => ['nullable', 'string', 'max:500'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:1000'],
            'image_path' => ['nullable', 'url', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Destination::create([
            'title' => $validated['title'],
            'location' => $validated['location'],
            'badge' => ($validated['badge'] ?? null) ?: 'Exclusive Sanctuary',
            'rating' => 4.95,
            'reviews_count' => random_int(45, 180),
            'duration_days' => $validated['duration_days'],
            'capacity' => $validated['capacity'] ?? 2,
            'amenities' => $validated['amenities'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_path' => ($validated['image_path'] ?? null) ?: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', "New luxury destination '{$validated['title']}' has been published to the catalog.");
    }

    /**
     * Update an existing package's info, price, dates, capacity, amenities, and status.
     */
    public function updateDestination(Request $request, Destination $destination): RedirectResponse
    {
        if (! $this->isAdmin($request->user())) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:100'],
            'duration_days' => ['required', 'integer', 'min:1', 'max:60'],
            'capacity' => ['nullable', 'integer', 'min:1', 'max:100'],
            'amenities' => ['nullable', 'string', 'max:500'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:1000'],
            'image_path' => ['nullable', 'url', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $destination->update([
            'title' => $validated['title'],
            'location' => $validated['location'],
            'badge' => ($validated['badge'] ?? null) ?: $destination->badge,
            'duration_days' => $validated['duration_days'],
            'capacity' => $validated['capacity'] ?? $destination->capacity,
            'amenities' => $validated['amenities'] ?? $destination->amenities,
            'start_date' => $validated['start_date'] ?? $destination->start_date,
            'end_date' => $validated['end_date'] ?? $destination->end_date,
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_path' => ($validated['image_path'] ?? null) ?: $destination->image_path,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()
            ->with('success', "Package '{$destination->title}' updated successfully.");
    }

    /**
     * Activate or deactivate a destination package.
     */
    public function toggleDestinationActive(Request $request, Destination $destination): RedirectResponse
    {
        if (! $this->isAdmin($request->user())) {
            abort(403, 'Unauthorized action.');
        }

        $destination->update([
            'is_active' => ! $destination->is_active,
        ]);

        $status = $destination->is_active ? 'Activated' : 'Deactivated';

        return redirect()->back()
            ->with('success', "Package '{$destination->title}' has been {$status}.");
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

    /**
     * Manage and issue a payment refund.
     */
    public function refundPayment(Request $request, Payment $payment): RedirectResponse
    {
        if (! $this->isAdmin($request->user())) {
            abort(403, 'Unauthorized action.');
        }

        $timestamp = now()->format('M d, Y H:i');

        $payment->update([
            'status' => 'refunded',
            'notes' => trim(($payment->notes ? $payment->notes."\n" : '')."Refunded by Admin on {$timestamp}"),
        ]);

        if ($payment->vacation) {
            $payment->vacation->update([
                'payment_status' => 'refunded',
                'status' => 'cancelled',
                'admin_notes' => trim(($payment->vacation->admin_notes ? $payment->vacation->admin_notes."\n" : '')."Payment refunded and reservation cancelled by Admin on {$timestamp}"),
            ]);
        }

        return redirect()->back()
            ->with('success', "Payment {$payment->transaction_reference} (RM ".number_format((float) $payment->amount, 2).') refunded successfully. Reservation status updated to Cancelled.');
    }
}
