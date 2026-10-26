<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerPaymentController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// Settings Page
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Language Switcher
Route::get('/lang/{locale}', function (Request $request, string $locale) {
    if (in_array($locale, ['en', 'ms'], true)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        cookie()->queue(cookie('locale', $locale, 60 * 24 * 365));
    }

    if ($request->filled('return_to')) {
        return redirect($request->input('return_to'))->with('status', $locale === 'ms' ? 'Bahasa berjaya ditukar ke Bahasa Melayu' : 'Language successfully switched to English');
    }

    return redirect()->back()->with('status', $locale === 'ms' ? 'Bahasa berjaya ditukar ke Bahasa Melayu' : 'Language successfully switched to English');
})->name('lang.switch');

// Authentication Routes
Route::view('/login', 'welcome')->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:login')
    ->name('login.store');

Route::get('/signup', [RegisterController::class, 'create'])->name('signup');
Route::post('/signup', [RegisterController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('signup.store');

Route::view('/about', 'about')->name('about');
Route::view('/customer', 'customer')->name('customer');

// Authenticated Area (Admin & Customer)
Route::middleware('auth')->group(function (): void {

    // Role Dispatcher / Common Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Admin Area
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/vacations/{vacation}/status', [AdminDashboardController::class, 'updateVacationStatus'])->name('admin.vacations.status');
    Route::post('/admin/destinations', [AdminDashboardController::class, 'storeDestination'])->name('admin.destinations.store');
    Route::put('/admin/destinations/{destination}', [AdminDashboardController::class, 'updateDestination'])->name('admin.destinations.update');
    Route::post('/admin/destinations/{destination}/toggle', [AdminDashboardController::class, 'toggleDestinationActive'])->name('admin.destinations.toggle');
    Route::delete('/admin/destinations/{destination}', [AdminDashboardController::class, 'destroyDestination'])->name('admin.destinations.destroy');
    Route::post('/admin/payments/{payment}/refund', [AdminDashboardController::class, 'refundPayment'])->name('admin.payments.refund');

    // Admin Profile Area
    Route::middleware(EnsureUserIsAdmin::class)->group(function (): void {
        Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
        Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    });

    // Customer Area
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/history', [CustomerDashboardController::class, 'history'])->name('customer.history');
    Route::get('/customer/profile', [CustomerProfileController::class, 'edit'])->name('customer.profile');
    Route::put('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
    Route::post('/customer/vacations', [CustomerDashboardController::class, 'store'])->name('customer.vacations.store');
    Route::post('/customer/vacations/{vacation}/cancel', [CustomerDashboardController::class, 'cancel'])->name('customer.vacations.cancel');

    // Customer Booking Payment & E-Voucher Routes
    Route::get('/customer/bookings/{vacation}/payment', [CustomerPaymentController::class, 'show'])->name('customer.payment.show');
    Route::post('/customer/bookings/{vacation}/payment', [CustomerPaymentController::class, 'process'])->name('customer.payment.process');
    Route::get('/customer/bookings/{vacation}/receipt', [CustomerPaymentController::class, 'receipt'])->name('customer.payment.receipt');

    // Admin Area (Protected by Administrator Privilege Middleware)
    Route::middleware(EnsureUserIsAdmin::class)->group(function (): void {
        Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
        Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

        // Admin Booking Management & Availability Check
        Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::post('/admin/bookings/{vacation}/approve', [AdminBookingController::class, 'approve'])->name('admin.bookings.approve');
        Route::post('/admin/bookings/{vacation}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
