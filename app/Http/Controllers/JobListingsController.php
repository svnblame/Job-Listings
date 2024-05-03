<?php

namespace App\Http\Controllers;

use App\Mail\JobListingPosted;
use App\Models\JobListing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobListingsController extends Controller
{
    const MODULE = 'job_listings';

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
            'title' => ['required', 'string', 'min:3'],
            'salary' => ['required', 'numeric'],
            'pay_frequency' => ['required', 'string'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
            'pay_frequency' => request('pay_frequency'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function store()
    {
        // @todo Refactor this... Just prototyping for now... Likely put contextual logging into middleware.
        $context = [
            'event' => 'stored.job_listing',
            'module' => self::MODULE,
        ];

        request()->validate([
            'title' => ['required', 'string', 'min:3'],
            'salary' => ['required', 'numeric'],
            'pay_frequency' => ['required', 'string'],
        ]);

        $jobListing = JobListing::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'pay_frequency' => request('pay_frequency'),
            'employer_id' => 221,
        ]);

        $context = array_merge($context, [
            'job_listing_id' => $jobListing->id,
            'title'          => $jobListing->title,
            'created_by'     => auth()->user()->email,
        ]);

        logger('Job Listing Stored', $context);

        Mail::to($jobListing->employer->user)->queue(
            new JobListingPosted($jobListing)
        );

        $context = [
            'event'          => 'notified.job_listing.created',
            'module'         => self::MODULE,
            'job_listing_id' => $jobListing->id,
            'sent_to'        => auth()->user()->email,
        ];

        logger('Job Listing Created Notification Sent', $context);

        return redirect('/jobs');
    }

    public function destroy(JobListing $job)
    {
        Gate::authorize('edit', $job);

        $job->delete();

        return redirect('/jobs');
    }
}
