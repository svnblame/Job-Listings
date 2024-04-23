<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array
    {
        return [
            [
                'id'     => 1,
                'title'  => 'Director',
                'salary' => '$50,000',
                'pay_frequency' => 'year',
            ],
            [
                'id'     => 2,
                'title'  => 'Programmer',
                'salary' => '$10,000',
                'pay_frequency' => 'month',
            ],
            [
                'id'     => 3,
                'title'  => 'Teacher',
                'salary' => '$40,000',
                'pay_frequency' => 'year',
            ]
        ];
    }

    public static function find(int $id): array
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);

        if (! $job) {
            abort(404, 'Job not found');
        }

        return $job;
    }
}
