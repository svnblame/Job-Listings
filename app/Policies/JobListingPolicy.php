<?php

namespace App\Policies;

use App\Models\JobListing;
use App\Models\User;

class JobListingPolicy
{
    public function edit(User $user, JobListing $jobListing): bool
    {
        return $jobListing->employer->user->is($user);
    }
}
