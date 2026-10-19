<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle customer login attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('customer.dashboard'))
                ->with('success', 'Selamat kembali, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'Emel atau kata laluan yang dimasukkan tidak sepadan.',
        ])->onlyInput('email');
    }

    /**
     * Show registration page.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle customer registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'confirmed', Password::min(6)],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Pendaftaran akaun berjaya! Selamat datang ke AzureVoyage.');
    }

    /**
     * Quick demo customer login for easy testing.
     */
    public function demoLogin(): RedirectResponse
    {
        $user = User::firstOrCreate(
            ['email' => 'pelanggan@azurevoyage.com'],
            [
                'name' => 'Siti Nur Aisyah',
                'phone' => '012-3456789',
                'address' => 'No. 12, Jalan Sultan Ismail, 50250 Kuala Lumpur',
                'password' => Hash::make('password123'),
            ]
        );

        Auth::login($user);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Log masuk sebagai akaun demo Pelanggan ('.$user->name.') berjaya!');
    }

    /**
     * Log the customer out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'Anda telah log keluar.');
    }
}
