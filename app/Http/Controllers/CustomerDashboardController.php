<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Display Customer Dashboard / My Bookings list with status tabs.
     */
    public function myBookings(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        // If not logged in, allow looking up booking by email or booking code, or redirect to login
        if (! $user) {
            // Check if guest is searching by code or email
            if ($request->filled('search_booking') || $request->filled('guest_email')) {
                $query = Booking::with('package');
                if ($request->filled('search_booking')) {
                    $query->where('booking_code', trim($request->search_booking));
                }
                if ($request->filled('guest_email')) {
                    $query->where('contact_email', trim($request->guest_email));
                }
                $bookings = $query->latest()->paginate(10);

                return view('customer.dashboard', [
                    'bookings' => $bookings,
                    'currentStatus' => 'all',
                    'isGuestLookup' => true,
                    'user' => null,
                ]);
            }

            // By default, if not logged in, auto-login demo user for frictionless review OR redirect
            // Let's check if the demo user exists so the user experience is smooth
            $demoUser = User::where('email', 'pelanggan@azurevoyage.com')->first();
            if ($demoUser) {
                Auth::login($demoUser);
                $user = $demoUser;
            } else {
                $bookings = Booking::whereRaw('1=0')->paginate(10);

                return view('customer.dashboard', [
                    'bookings' => $bookings,
                    'currentStatus' => 'all',
                    'isGuestLookup' => true,
                    'user' => null,
                ]);
            }
        }

        $status = $request->get('status', 'all');

        $query = Booking::with('package')
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->orWhere('contact_email', $user->email);
            });

        if ($status !== 'all' && in_array($status, ['Pending', 'Confirmed', 'Cancelled', 'Completed'])) {
            $query->where('status', $status);
        }

        $bookings = $query->latest()->paginate(8)->withQueryString();

        // Status counts for tab badges
        $counts = [
            'all' => Booking::where(fn ($q) => $q->where('user_id', $user->id)->orWhere('contact_email', $user->email))->count(),
            'Pending' => Booking::where(fn ($q) => $q->where('user_id', $user->id)->orWhere('contact_email', $user->email))->where('status', 'Pending')->count(),
            'Confirmed' => Booking::where(fn ($q) => $q->where('user_id', $user->id)->orWhere('contact_email', $user->email))->where('status', 'Confirmed')->count(),
            'Completed' => Booking::where(fn ($q) => $q->where('user_id', $user->id)->orWhere('contact_email', $user->email))->where('status', 'Completed')->count(),
            'Cancelled' => Booking::where(fn ($q) => $q->where('user_id', $user->id)->orWhere('contact_email', $user->email))->where('status', 'Cancelled')->count(),
        ];

        return view('customer.dashboard', [
            'bookings' => $bookings,
            'currentStatus' => $status,
            'counts' => $counts,
            'user' => $user,
            'isGuestLookup' => false,
        ]);
    }

    /**
     * Cancel an existing booking.
     */
    public function cancelBooking(Request $request, string $bookingCode): RedirectResponse
    {
        $booking = Booking::where('booking_code', $bookingCode)->firstOrFail();

        // Check ownership if user logged in
        if (Auth::check() && $booking->user_id && $booking->user_id !== Auth::id()) {
            abort(403, 'Akses tidak dibenarkan.');
        }

        if ($booking->status === 'Completed') {
            return back()->with('error', 'Tempahan yang telah selesai tidak boleh dibatalkan.');
        }

        $booking->update([
            'status' => 'Cancelled',
        ]);

        return back()->with('success', "Tempahan {$booking->booking_code} telah berjaya dibatalkan.");
    }

    /**
     * Show customer profile page.
     */
    public function profile(): View|RedirectResponse
    {
        if (! Auth::check()) {
            $demoUser = User::where('email', 'pelanggan@azurevoyage.com')->first();
            if ($demoUser) {
                Auth::login($demoUser);
            } else {
                return redirect()->route('login')->with('info', 'Sila log masuk untuk menguruskan profil anda.');
            }
        }

        return view('customer.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update customer personal details.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil maklumat diri anda berjaya dikemas kini!');
    }

    /**
     * Update customer account password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(6)],
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Kata laluan semasa tidak tepat.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Kata laluan anda berjaya dikemas kini!');
    }
}
