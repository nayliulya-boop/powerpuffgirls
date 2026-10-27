<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Payment;
use App\Models\User;
use App\Models\Vacation;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Display the customer dashboard with their vacation bookings and stats.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        $role = DB::table('login')
            ->where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->value('role');

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('search', ''));

        $vacationsQuery = $user->vacations();

        if ($status === 'upcoming') {
            $vacationsQuery->whereIn('status', ['upcoming', 'ongoing', 'approved', 'pending_approval']);
        } elseif ($status === 'completed') {
            $vacationsQuery->where('status', 'completed');
        } elseif ($status === 'cancelled') {
            $vacationsQuery->whereIn('status', ['cancelled', 'rejected']);
        } elseif (in_array($status, ['pending_approval', 'approved', 'rejected', 'ongoing'], true)) {
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
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = $this->calculateStats($user);

        $nextTrip = $user->vacations()
            ->where('status', 'upcoming')
            ->orderBy('start_date')
            ->first();

        $destinationsQuery = Destination::query();
        if (Schema::hasColumn('destinations', 'is_active')) {
            $destinationsQuery->where('is_active', true);
        }

        return view('customer.dashboard', [
            'user' => $user,
            'vacations' => $vacations,
            'stats' => $stats,
            'status' => $status,
            'search' => $search,
            'nextTrip' => $nextTrip,
            'destinations' => $destinationsQuery->get(),
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
            ->where('status', 'completed')
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
        $pendingApprovalCount = $allUserVacations->where('status', 'pending_approval')->count();
        $approvedCount = $allUserVacations->where('status', 'approved')->count();
        $upcomingCount = $allUserVacations->whereIn('status', ['upcoming', 'ongoing', 'approved', 'pending_approval'])->count();
        $completedCount = $allUserVacations->where('status', 'completed')->count();
        $cancelledCount = $allUserVacations->whereIn('status', ['cancelled', 'rejected'])->count();
        $totalSpend = (float) $allUserVacations->where('payment_status', 'paid')->sum('price');

        $loyaltyPoints = (int) round($totalSpend * 1.5);

        $vipTier = match (true) {
            $totalSpend >= 25000 => 'Diamond Sovereign VIP',
            $totalSpend >= 10000 => 'Platinum Horizon VIP',
            default => 'Signature Gold VIP',
        };

        return [
            'totalBookings' => $totalBookings,
            'pendingApprovalCount' => $pendingApprovalCount,
            'approvedCount' => $approvedCount,
            'upcomingCount' => $upcomingCount,
            'completedCount' => $completedCount,
            'cancelledCount' => $cancelledCount,
            'totalSpend' => $totalSpend,
            'loyaltyPoints' => $loyaltyPoints,
            'vipTier' => $vipTier,
        ];
    }

    /**
     * Store a new vacation booking for the authenticated customer and immediately proceed to payment.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'destination_id' => ['required_without:destination', 'nullable', 'integer'],
            'destination' => ['required_without:destination_id', 'nullable', 'string', 'max:255'],
            'title' => ['required_without:destination_id', 'nullable', 'string', 'max:255'],
            'start_date' => ['required_without:destination_id', 'nullable', 'date'],
            'end_date' => ['required_without:destination_id', 'nullable', 'date'],
            'travelers_count' => ['required', 'integer', 'min:1', 'max:12'],
            'tier' => ['required', 'string', 'in:Signature Gold,Platinum Horizon,Diamond Sovereign'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $destinationModel = null;
        if (! empty($validated['destination_id'])) {
            $destinationModel = Destination::find($validated['destination_id']);
        } elseif (! empty($validated['destination']) || ! empty($validated['title'])) {
            $search = $validated['destination'] ?? $validated['title'];
            $destinationModel = Destination::where('location', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%")
                ->first();
        }

        $destination = $destinationModel ? $destinationModel->location : ($validated['destination'] ?? 'Luxury Vacation Destination');
        $title = $destinationModel ? $destinationModel->title : ($validated['title'] ?? 'Luxury Travel Escape');
        $imageUrl = $destinationModel?->image_path ?: null;

        $travelersCount = max(1, (int) ($validated['travelers_count'] ?? 1));
        if ($destinationModel && $destinationModel->capacity && $travelersCount > (int) $destinationModel->capacity) {
            $travelersCount = (int) $destinationModel->capacity;
        }

        if ($destinationModel) {
            $startDate = ! empty($validated['start_date'])
                ? Carbon::parse($validated['start_date'])
                : ($destinationModel->start_date ? Carbon::parse($destinationModel->start_date) : now()->addDays(7));

            $endDate = ! empty($validated['end_date'])
                ? Carbon::parse($validated['end_date'])
                : ($destinationModel->end_date
                    ? Carbon::parse($destinationModel->end_date)
                    : (clone $startDate)->addDays($destinationModel->duration_days ?: 4));

            // Price is for 1 capacity, auto-calculated based on capacity chosen by customer
            $price = round((float) $destinationModel->price * $travelersCount, 2);
        } else {
            $startDate = Carbon::parse($validated['start_date'] ?? now()->addDays(7));
            $endDate = Carbon::parse($validated['end_date'] ?? (clone $startDate)->addDays(4));
            $nights = max(1, $startDate->diffInDays($endDate));

            $baseRate = match ($validated['tier']) {
                'Diamond Sovereign' => 1850.00,
                'Platinum Horizon' => 1250.00,
                default => 850.00,
            };

            $tierMultiplier = match ($validated['tier']) {
                'Diamond Sovereign' => 1.35,
                'Platinum Horizon' => 1.15,
                default => 1.0,
            };

            $price = round($baseRate * $nights * $tierMultiplier * (1 + ($travelersCount - 1) * 0.35), 2);
        }

        if (! $imageUrl) {
            $destinationLower = strtolower($destination);
            $imageUrl = match (true) {
                str_contains($destinationLower, 'redang') => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
                str_contains($destinationLower, 'langkawi') => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
                str_contains($destinationLower, 'maldives') => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80',
                str_contains($destinationLower, 'amalfi') || str_contains($destinationLower, 'italy') => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=800&q=80',
                str_contains($destinationLower, 'swiss') || str_contains($destinationLower, 'alps') || str_contains($destinationLower, 'zermatt') => 'https://images.unsplash.com/photo-1502784444187-359ac186c5bb?auto=format&fit=crop&w=800&q=80',
                str_contains($destinationLower, 'santorini') || str_contains($destinationLower, 'greece') => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=800&q=80',
                default => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
            };
        } elseif (! str_starts_with($imageUrl, 'http')) {
            $imageUrl = asset($imageUrl);
        }

        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $destination), 0, 3));
        if (strlen($prefix) < 3) {
            $prefix = 'VOY';
        }
        $packageCode = 'AV-'.$prefix.'-'.random_int(100, 999);

        // Save the booking into the vacations database table
        $vacation = $request->user()->vacations()->create([
            'package_code' => $packageCode,
            'destination' => $destination,
            'title' => $title,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'travelers_count' => $travelersCount,
            'price' => $price,
            'status' => 'approved',
            'payment_status' => 'unpaid',
            'tier' => $validated['tier'],
            'image_url' => $imageUrl,
            'notes' => $validated['notes'] ?? null,
            'admin_notes' => 'Tempahan pakej berjaya didaftarkan ke dalam pangkalan data. Menunggu bayaran pelanggan.',
        ]);

        return redirect()->route('customer.payment.show', $vacation)
            ->with('success', "✨ Pakej {$title} (#{$packageCode}) berjaya didaftarkan ke dalam pangkalan data (Jadual vacations)! Sila lengkapkan pembayaran di bawah.");
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
