<?php

use Illuminate\Support\Facades\Route;
use App\Models\JobListing;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/team', function () {
    return view('team');
});

Route::get('/jobs', function () {
    $jobs = JobListing::with('employer')->latest()->cursorPaginate(5);

    return view('job_listings.index', compact('jobs'), [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('job_listings.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = JobListing::find($id);

    return view('job_listings.show', ['job' => $job]);
});

Route::post('/jobs', function () {
    // validation ...

    JobListing::create([
        'title'         => request('title'),
        'salary'        => request('salary'),
        'pay_frequency' => request('pay_frequency'),
        'employer_id'   => 1   // hard-coding for now, until authentication is in place...
    ]);

    return redirect('/jobs');
});
