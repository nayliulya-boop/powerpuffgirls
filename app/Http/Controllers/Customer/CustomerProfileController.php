<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerProfileController extends Controller
{
    /**
     * Display the customer profile edit form with traveler statistics.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

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

        $stats = [
            'totalBookings' => $totalBookings,
            'upcomingCount' => $upcomingCount,
            'completedCount' => $completedCount,
            'cancelledCount' => $cancelledCount,
            'totalSpend' => $totalSpend,
            'loyaltyPoints' => $loyaltyPoints,
            'vipTier' => $vipTier,
        ];

        return view('customer.profile', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }

    /**
     * Update the customer profile and sync credentials to the database.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($user, $validated): void {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? null;
            $user->address = $validated['address'] ?? null;
            $user->bio = $validated['bio'] ?? null;

            if (! empty($validated['new_password'])) {
                $user->password = Hash::make($validated['new_password']);
            }

            $user->save();

            $loginUpdates = [
                'email' => Str::lower($user->email),
            ];

            if (! empty($validated['new_password'])) {
                $loginUpdates['password'] = Hash::make($validated['new_password']);
            }

            DB::table('login')->updateOrInsert(
                ['user_id' => $user->id],
                array_merge($loginUpdates, [
                    'role' => $user->role,
                    'deleted_at' => null,
                ])
            );
        });

        return redirect()->route('customer.profile')
            ->with('status', '✨ Profile updated successfully! All details have been saved to your account.');
    }
}
