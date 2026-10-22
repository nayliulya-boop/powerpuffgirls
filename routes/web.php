<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// Home Page (AzureVoyage luxury travel home)
Route::view('/', 'home')->name('home');
Route::view('/home', 'home');

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
    Route::post('/customer/vacations', [CustomerDashboardController::class, 'store'])->name('customer.vacations.store');
    Route::post('/customer/vacations/{vacation}/cancel', [CustomerDashboardController::class, 'cancel'])->name('customer.vacations.cancel');
    Route::get('/customer/profile', [CustomerProfileController::class, 'edit'])->name('customer.profile');
    Route::put('/customer/profile', [CustomerProfileController::class, 'update'])->name('customer.profile.update');

    // Admin Area (Protected by Administrator Privilege Middleware)
    Route::middleware(EnsureUserIsAdmin::class)->group(function (): void {
        Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
        Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    });

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
