<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => fake()->firstName,
            'lname' => fake()->lastName,
            'course' => fake()->randomElement(['BSCRIM','BSHM','BSBA','BSIT','BSA','BSN','BSED']),
            'year' => fake()->randomElement(['1','2','3','4']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->e164PhoneNumber,
        ];
    }
}
