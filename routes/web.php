<?php

use Illuminate\Support\Facades\Route;

// Home Page (AzureVoyage luxury travel home)
Route::view('/', 'home')->name('home');
Route::view('/home', 'home');

// Login Page (Travel agency portal test login)
Route::view('/login', 'welcome')->name('login');

// About Page (Simple test page, no database connection)
Route::view('/about', 'about')->name('about');

// Customer Page (VIP club, client activity, and inquiry)
Route::view('/customer', 'customer')->name('customer');
