<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Supplier::factory(3)->create();

        User::factory(1)->create([
            'name' => 'Blaze Douglas',
            'email' => 'cashier@test.com',
            'password' => 'Cashier123'
        ]);

        User::factory()->create([
            'name' => 'Aileen Stehr',
            'email' => 'admin@test.com',
            'password' => 'Admin123',
        ]);

        Employee::factory()->create([
            'email' => 'cashier@test.com',
            'name' => 'Blaze Douglas',
        ]);

        Employee::factory()->create([
            'email' => 'admin@test.com',
            'name' => 'Aileen Stehr',
        ]);
    }
}
