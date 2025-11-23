<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // universal password
            'remember_token' => Str::random(10),

            // Your extra fields
            'major' => $this->faker->randomElement(['Computer Science', 'IT', 'Networking', 'Cybersecurity']),
            'year_of_study' => $this->faker->randomElement(['first_year','second_year','third_year','fourth_year']),
            'points' => rand(0,200),
            'xp_level' => rand(1,5),
        ];
    }
}
