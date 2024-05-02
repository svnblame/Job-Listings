<?php

namespace App\Http\Controllers;

use App\Mail\JobListingPosted;
use App\Models\JobListing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobListingsController extends Controller
{
    public function index()
    {
        $jobs = JobListing::with('employer')
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        return view('job_listings.index', compact('jobs'), [
            'jobs' => $jobs
        ]);
    }

    public function show(JobListing $job)
    {
        return view('job_listings.show', ['job' => $job]);
    }

    public function create()
    {
        return view('job_listings.create');
    }

    public function edit(JobListing $job)
    {
        Gate::authorize('edit', $job);

        return view('job_listings.edit', ['job' => $job]);
    }

    public function update(JobListing $job)
    {
        Gate::authorize('edit', $job);

        request()->validate([
            'title'         => ['required', 'string', 'min:3'],
            'salary'        => ['required', 'numeric'],
            'pay_frequency' => ['required', 'string'],
        ]);

        $job->update([
            'title'         => request('title'),
            'salary'        => request('salary'),
            'pay_frequency' => request('pay_frequency'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function store()
    {
        request()->validate([
            'title'         => ['required', 'string', 'min:3'],
            'salary'        => ['required', 'numeric'],
            'pay_frequency' => ['required', 'string'],
        ]);

        $jobListing = JobListing::create([
            'title'         => request('title'),
            'salary'        => request('salary'),
            'pay_frequency' => request('pay_frequency'),
            'employer_id'   => 1   // hard-coding for now, until authentication is in place...
        ]);

        Mail::to($jobListing->employer->user)->send(
            new JobListingPosted($jobListing)
        );

        return redirect('/jobs');
    }

    public function destroy(JobListing $job)
    {
        Gate::authorize('edit', $job);

        $job->delete();

        return redirect('/jobs');
    }
}
