<?php

use App\Http\Controllers\JobListingsController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

// Display home page
Route::view('/', 'home');

// Display about page
Route::view('/about', 'about');

// Display contact page
Route::view('/contact', 'contact');

// Display team page
Route::view('/team', 'team');

// Job Listing Resource
Route::resource('jobs', JobListingsController::class);

// Authentication
Route::get('/register', [UserRegistrationController::class, 'create'])->name('auth.register');
Route::post('/register', [UserRegistrationController::class, 'store'])->name('auth.store');

Route::get('/login', [UserLoginController::class, 'create'])->name('auth.login');
Route::post('/login', [UserLoginController::class, 'store'])->name('auth.store');
Route::post('/logout', [UserLoginController::class, 'destroy'])->name('auth.destroy');
