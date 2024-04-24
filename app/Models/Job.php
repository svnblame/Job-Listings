<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model {
    use HasFactory;

    protected $table = 'job_listings';
    protected $fillable = ['title', 'salary', 'pay_frequency'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }
}
