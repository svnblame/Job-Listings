<?php

use App\Http\Controllers\JobListingsController;
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
Route::resource('jobs', JobListingsController::class);
