<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle,
            'salary' => '$' . rand(10000, 100000),
            'schedule' => fake()->randomElement(['Full-time', 'Part-time']),
            'location' => fake()->randomElement(['On-site', 'Remote']),
            'featured' => fake()->randomElement([true, false]),
            'url' => fake()->url,
        ];
    }
}
