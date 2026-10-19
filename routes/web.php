<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - AzureVoyage Travel & Tours System
|--------------------------------------------------------------------------
*/

// 1. Laman Utama (Home)
Route::view('/', 'home')->name('home');
Route::view('/home', 'home');

// 2. Tentang Kami (About Us)
Route::view('/about', 'about')->name('about');

// 3. Hubungi Kami & Testimoni Pelanggan (Contact Us & Reviews)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/inquiry', [ContactController::class, 'storeInquiry'])->name('contact.inquiry');
Route::post('/contact/review', [ContactController::class, 'storeReview'])->name('contact.review');

// 4. Autentikasi Pelanggan (Customer Auth: Register, Login, Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('signup');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/demo-customer', [AuthController::class, 'demoLogin'])->name('auth.demo');

// 5. Katalog Pakej Pelancongan (Packages Catalog & Details)
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

// 6. Aliran Tempahan & Pembayaran (Booking Flow, Payment & E-Voucher)
Route::get('/packages/{slug}/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/packages/{slug}/book', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking_code}/payment', [BookingController::class, 'payment'])->name('booking.payment');
Route::post('/booking/{booking_code}/payment', [BookingController::class, 'processPayment'])->name('booking.process_payment');
Route::get('/booking/{booking_code}/voucher', [BookingController::class, 'voucher'])->name('booking.voucher');

// 7. Modul Pelanggan Dashboard (My Bookings & Profile Management)
Route::get('/customer', [CustomerDashboardController::class, 'myBookings'])->name('customer');
Route::get('/customer/bookings', [CustomerDashboardController::class, 'myBookings'])->name('customer.dashboard');
Route::post('/customer/bookings/{booking_code}/cancel', [CustomerDashboardController::class, 'cancelBooking'])->name('customer.cancel_booking');
Route::get('/customer/profile', [CustomerDashboardController::class, 'profile'])->name('customer.profile');
Route::post('/customer/profile', [CustomerDashboardController::class, 'updateProfile'])->name('customer.update_profile');
Route::post('/customer/profile/password', [CustomerDashboardController::class, 'updatePassword'])->name('customer.update_password');
