<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    /**
     * Display all customer bookings for administrator availability review and monitoring.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $query = Vacation::with(['user', 'reviewer', 'latestPayment']);

        if (in_array($status, ['pending_approval', 'approved', 'rejected', 'upcoming', 'ongoing', 'completed', 'cancelled'], true)) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('package_code', 'like', "%{$search}%")
                    ->orWhere('destination', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search): void {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Always display newest bookings first so any recent booking is immediately visible at the top
        $bookings = $query
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'totalBookings' => Vacation::count(),
            'pendingApprovalCount' => Vacation::where('status', 'pending_approval')->count(),
            'approvedCount' => Vacation::where('status', 'approved')->count(),
            'paidCount' => Vacation::where('payment_status', 'paid')->count(),
            'totalRevenue' => (float) Vacation::where('payment_status', 'paid')->sum('price'),
        ];

        return view('admin.bookings.index', [
            'bookings' => $bookings,
            'stats' => $stats,
            'status' => $status,
            'search' => $search,
        ]);
    }

    /**
     * Mark a customer booking as available and approved for payment settlement.
     */
    public function approve(Vacation $vacation, Request $request): RedirectResponse
    {
        $request->validate([
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $defaultNote = 'Slots, luxury accommodations, and transport are verified available. Proceed to payment.';
        $notes = $request->filled('admin_notes') ? $request->input('admin_notes') : $defaultNote;

        $vacation->update([
            'status' => 'approved',
            'admin_notes' => $notes,
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return redirect()->back()
            ->with('status', "✓ Booking #{$vacation->package_code} for {$vacation->user->name} marked as AVAILABLE! Customer can now proceed to payment.");
    }

    /**
     * Mark a customer booking as unavailable and rejected.
     */
    public function reject(Vacation $vacation, Request $request): RedirectResponse
    {
        $request->validate([
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $defaultNote = 'Unfortunately, luxury slots are fully booked on the selected dates. Please choose alternate dates.';
        $notes = $request->filled('admin_notes') ? $request->input('admin_notes') : $defaultNote;

        $vacation->update([
            'status' => 'rejected',
            'admin_notes' => $notes,
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return redirect()->back()
            ->with('status', "Booking #{$vacation->package_code} has been marked as NOT AVAILABLE (Rejected). Customer has been notified.");
    }
}
