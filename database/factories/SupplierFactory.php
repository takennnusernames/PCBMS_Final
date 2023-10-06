<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Company Name' => fake()->unique()->company(),
            'Company Acronym' => fake()->word(),
            'Address' => fake()->address(),
            'Contact Person' => fake()->name(),
            'Contact Number' => fake()->phoneNumber(),
            'Email Address' => fake()->unique()->safeEmail(),
        ];
    }
}
