<?php

use App\Http\Controllers\JobListingsController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegistrationController;
use App\Models\JobListing;
use Illuminate\Support\Facades\Route;

// Display home page
Route::view('/', 'home');

// Display about page
Route::view('/about', 'about');

// Display contact page
Route::view('/contact', 'contact');

// Display team page
Route::view('/team', 'team');

// Job Listings
Route::get('/jobs', [JobListingsController::class, 'index'])
    ->name('jobs.index');

Route::get('/jobs/create', [JobListingsController::class, 'create'])
    ->name('jobs.create');

Route::post('/jobs', [JobListingsController::class, 'store'])
    ->name('jobs.store')
    ->middleware('auth');

Route::get('/jobs/{job}', [JobListingsController::class, 'show'])
    ->name('jobs.show');

Route::get('/jobs/{job}/edit', [JobListingsController::class, 'edit'])
    ->name('jobs.edit')
    ->middleware('auth');

Route::patch('/jobs/{job}', [JobListingsController::class, 'update'])
    ->name('jobs.update')
    ->middleware('auth');

Route::delete('/jobs/{job}', [JobListingsController::class, 'destroy'])
    ->name('jobs.destroy')
    ->middleware('auth');

// User Registration
Route::get('/register', [UserRegistrationController::class, 'create'])->name('register');

Route::post('/register', [UserRegistrationController::class, 'store'])->name('store');

// User Login
Route::get('/login', [UserLoginController::class, 'create'])->name('login');

Route::post('/login', [UserLoginController::class, 'store'])->name('store');

Route::post('/logout', [UserLoginController::class, 'destroy'])->name('destroy');
