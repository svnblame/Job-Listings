<?php

namespace App\Jobs;

use App\Models\JobListing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TranslateJobListing implements ShouldQueue
{
    const MODULE = 'job_listings';

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public JobListing $jobListing)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $context = [
            'event'          => 'translating.job_listing',
            'module'         => self::MODULE,
            'job_listing_id' => $this->jobListing->id,
            'title'          => $this->jobListing->title,
            'from'           => 'English',
            'to'             => 'Spanish'
        ];

        logger('Translating Job Listing', $context);

        // Simulate job listing translation process
        $sleepSeconds = rand(4, 10);
        sleep($sleepSeconds);

        $context['event'] = 'translated.job_listing';

        logger('Translated Job Listing', $context);
    }
}
