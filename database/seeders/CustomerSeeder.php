<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 customers, each with 3 users and each user with 3 sessions
        Customer::factory()
        ->count(3)
        ->has(User::factory()
            ->count(3)
            ->hasSessions(3)
        )
        ->create();
    }
}
