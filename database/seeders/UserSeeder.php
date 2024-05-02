<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Test User
        User::create([
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'jdoe@example.com',
            'password'   => bcrypt('P4ssw0rd*'),
        ]);

        User::factory()->create([
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
        ]);
    }
}
