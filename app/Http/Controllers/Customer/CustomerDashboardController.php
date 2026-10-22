<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Display the customer dashboard with their vacation bookings and stats.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $vacationsQuery = $user->vacations();

        if (in_array($status, ['upcoming', 'ongoing', 'completed', 'cancelled'], true)) {
            $vacationsQuery->where('status', $status);
        }

        if ($search !== '') {
            $vacationsQuery->where(function ($query) use ($search): void {
                $query->where('destination', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('package_code', 'like', "%{$search}%");
            });
        }

        $vacations = $vacationsQuery
            ->orderBy('start_date', 'desc')
            ->get();

        $stats = $this->calculateStats($user);

        $nextTrip = $user->vacations()
            ->where('status', 'upcoming')
            ->orderBy('start_date')
            ->first();

        return view('customer.dashboard', [
            'user' => $user,
            'vacations' => $vacations,
            'stats' => $stats,
            'status' => $status,
            'search' => $search,
            'nextTrip' => $nextTrip,
            'destinations' => Destination::all(),
        ]);
    }

    /**
     * Display the customer profile page.
     */
    public function profile(Request $request): View
    {
        $user = $request->user();
        $stats = $this->calculateStats($user);

        return view('customer.profile', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }

    /**
     * Display the customer vacation history page.
     */
    public function history(Request $request): View
    {
        $user = $request->user();
        $stats = $this->calculateStats($user);

        $vacations = $user->vacations()
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('start_date', 'desc')
            ->get();

        return view('customer.history', [
            'user' => $user,
            'stats' => $stats,
            'vacations' => $vacations,
        ]);
    }

    /**
     * Calculate and return luxury customer statistics.
     *
     * @return array{totalBookings: int, upcomingCount: int, completedCount: int, cancelledCount: int, totalSpend: float, loyaltyPoints: int, vipTier: string}
     */
    private function calculateStats(User $user): array
    {
        $allUserVacations = $user->vacations()->get();

        $totalBookings = $allUserVacations->count();
        $upcomingCount = $allUserVacations->where('status', 'upcoming')->count();
        $completedCount = $allUserVacations->where('status', 'completed')->count();
        $cancelledCount = $allUserVacations->where('status', 'cancelled')->count();
        $totalSpend = (float) $allUserVacations->whereIn('status', ['upcoming', 'ongoing', 'completed'])->sum('price');

        $loyaltyPoints = (int) round($totalSpend * 1.5);

        $vipTier = match (true) {
            $totalSpend >= 25000 => 'Diamond Sovereign VIP',
            $totalSpend >= 10000 => 'Platinum Horizon VIP',
            default => 'Signature Gold VIP',
        };

        return [
            'totalBookings' => $totalBookings,
            'upcomingCount' => $upcomingCount,
            'completedCount' => $completedCount,
            'cancelledCount' => $cancelledCount,
            'totalSpend' => $totalSpend,
            'loyaltyPoints' => $loyaltyPoints,
            'vipTier' => $vipTier,
        ];
    }

    /**
     * Store a new vacation booking for the authenticated customer.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'destination' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'travelers_count' => ['required', 'integer', 'min:1', 'max:12'],
            'tier' => ['required', 'string', 'in:Signature Gold,Platinum Horizon,Diamond Sovereign'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $nights = max(1, $startDate->diffInDays($endDate));

        $ratePerNight = match ($validated['tier']) {
            'Diamond Sovereign' => 1850.00,
            'Platinum Horizon' => 1250.00,
            default => 850.00,
        };

        $price = round($ratePerNight * $nights * (1 + ($validated['travelers_count'] - 1) * 0.35), 2);

        $destinationLower = strtolower($validated['destination']);
        $imageUrl = match (true) {
            str_contains($destinationLower, 'maldives') => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
            str_contains($destinationLower, 'amalfi') || str_contains($destinationLower, 'italy') => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=800&q=80',
            str_contains($destinationLower, 'swiss') || str_contains($destinationLower, 'alps') || str_contains($destinationLower, 'zermatt') => 'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?auto=format&fit=crop&w=800&q=80',
            str_contains($destinationLower, 'santorini') || str_contains($destinationLower, 'greece') => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=800&q=80',
            str_contains($destinationLower, 'japan') || str_contains($destinationLower, 'kyoto') || str_contains($destinationLower, 'tokyo') => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=800&q=80',
            str_contains($destinationLower, 'bora') => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            default => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
        };

        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $validated['destination']), 0, 3));
        if (strlen($prefix) < 3) {
            $prefix = 'VOY';
        }
        $packageCode = 'AV-'.$prefix.'-'.random_int(100, 999);

        $request->user()->vacations()->create([
            'package_code' => $packageCode,
            'destination' => $validated['destination'],
            'title' => $validated['title'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'travelers_count' => $validated['travelers_count'],
            'price' => $price,
            'status' => 'upcoming',
            'tier' => $validated['tier'],
            'image_url' => $imageUrl,
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('customer.dashboard')
            ->with('success', "✨ Splendid! Your luxury vacation to {$validated['destination']} has been booked ({$packageCode}). Your private concierge is preparing your welcome pack.");
    }

    /**
     * Cancel an upcoming vacation for the authenticated customer.
     */
    public function cancel(Vacation $vacation, Request $request): RedirectResponse
    {
        if ($vacation->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($vacation->status === 'cancelled') {
            return redirect()->route('customer.dashboard')
                ->with('info', 'This vacation is already cancelled.');
        }

        $vacation->update([
            'status' => 'cancelled',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('info', "Your booking for {$vacation->title} ({$vacation->package_code}) has been marked as cancelled.");
    }
}
