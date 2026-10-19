<?php

use Illuminate\Support\Facades\Route;

// Home Page (AzureVoyage luxury travel home)
Route::view('/', 'home')->name('home');
Route::view('/home', 'home');

// Login Page
Route::view('/login', 'welcome')->name('login');

// Sign Up Page
Route::view('/signup', 'signup')->name('signup');

// About Page
Route::view('/about', 'about')->name('about');

// Customer Page (VIP club, client activity, and inquiry)
Route::view('/customer', 'customer')->name('customer');
