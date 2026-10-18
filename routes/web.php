<?php

use Illuminate\Support\Facades\Route;
Route::view('/', 'welcome')->name('welcome');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::view('/home', 'home')->name('home');
