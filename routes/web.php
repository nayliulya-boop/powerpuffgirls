<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerPaymentController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// Home Page (AzureVoyage luxury travel home)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// Login Page (Travel agency portal test login)
Route::view('/login', 'welcome')->name('login');
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:login')
    ->name('login.store');

// Sign Up Page (Minimal test signup page)
Route::view('/signup', 'signup')->name('signup');

// About Page (Simple test page, no database connection)
Route::view('/about', 'about')->name('about');

// Customer Page (VIP club, client activity, and inquiry)
Route::view('/customer', 'customer')->name('customer');

// Authenticated Area
Route::middleware('auth')->group(function (): void {
    // Role Dispatcher
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Customer Area
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/history', [CustomerDashboardController::class, 'history'])->name('customer.history');
    Route::post('/customer/vacations', [CustomerDashboardController::class, 'store'])->name('customer.vacations.store');
    Route::post('/customer/vacations/{vacation}/cancel', [CustomerDashboardController::class, 'cancel'])->name('customer.vacations.cancel');
    Route::get('/customer/profile', [CustomerProfileController::class, 'edit'])->name('customer.profile');
    Route::put('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');

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

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
