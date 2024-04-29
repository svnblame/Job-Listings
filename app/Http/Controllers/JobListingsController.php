<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
//use Illuminate\Http\Request;

class JobListingsController extends Controller
{
    public function index()
    {
        $jobs = JobListing::with('employer')
            ->latest()
            ->cursorPaginate(5);

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
        return view('job_listings.edit', ['job' => $job]);
    }

    public function update(JobListing $job)
    {
        // TODO authorize (On hold until Auth is implemented) ...

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

        JobListing::create([
            'title'         => request('title'),
            'salary'        => request('salary'),
            'pay_frequency' => request('pay_frequency'),
            'employer_id'   => 1   // hard-coding for now, until authentication is in place...
        ]);

        return redirect('/jobs');
    }

    public function destroy(JobListing $job)
    {
        // TODO authorize (On hold until Auth is implemented) ...

        $job->delete();

        return redirect('/jobs');
    }
}
