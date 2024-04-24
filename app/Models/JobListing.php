<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobListing extends Model {
    use HasFactory;

    protected $table = 'job_listings';
    protected $fillable = ['title', 'salary', 'pay_frequency'];

    /* A JobListing "belongs to" an Employer */
    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }

    public function salaryUS(): string
    {
        return '$' . number_format(sprintf('%0.2f', $this->salary));
    }
}
