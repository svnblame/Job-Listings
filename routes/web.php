<?php

use Illuminate\Support\Facades\Route;
use App\Models\JobListing;

// Display home page
Route::get('/', function () {
    return view('home');
});

// Display about page
Route::get('/about', function () {
    return view('about');
});

// Display contact page
Route::get('/contact', function () {
    return view('contact');
});

// Display team page
Route::get('/team', function () {
    return view('team');
});

// Index : Display all job listings
Route::get('/jobs', function () {
    $jobs = JobListing::with('employer')
        ->latest()
        ->cursorPaginate(5);

    return view('job_listings.index', compact('jobs'), [
        'jobs' => $jobs
    ]);
});

// Create : Display form to create a new job listing
Route::get('/jobs/create', function () {
    return view('job_listings.create');
});

// Show : Display a specific job listing
Route::get('/jobs/{id}', function ($id) {
    $job = JobListing::find($id);

    return view('job_listings.show', ['job' => $job]);
});

// Store : Create a new job listing
Route::post('/jobs', function () {
    request()->validate([
        'title'         => ['required', 'string', 'min:3'],
        'salary'        => ['required', 'numeric'],
        'pay_frequency' => ['required', 'string'],
    ]);

    JobListing::create([
        'title'         => request('title'),
        'salary'        => request('salary'),
        'pay_frequency' => request('pay_frequency'),
        'employer_id'   => 1   // hard-coding for now, until authentication is in place...
    ]);

    return redirect('/jobs');
});

// Edit : Display form to edit a specific job listing
Route::get('/jobs/{id}/edit', function ($id) {
    $job = JobListing::find($id);

    return view('job_listings.edit', ['job' => $job]);
});

// Update : Update a specific job listing
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title'         => ['required', 'string', 'min:3'],
        'salary'        => ['required', 'numeric'],
        'pay_frequency' => ['required', 'string'],
    ]);

    // authorize (On hold until Auth is implemented) ...

    // TODO Refactor to use Route Model Binding
    $job = JobListing::findOrFail($id);

    $job->update([
        'title'         => request('title'),
        'salary'        => request('salary'),
        'pay_frequency' => request('pay_frequency'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Destroy : Delete a specific job listing
Route::delete('/jobs/{id}', function ($id) {
    // authorize (On hold until Auth is implemented) ...

    JobListing::findOrFail($id)->delete();

    return redirect('/jobs');

});
