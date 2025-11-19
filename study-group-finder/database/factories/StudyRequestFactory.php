<?php

namespace Database\Factories;

use App\Models\StudyRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyRequestFactory extends Factory
{
    protected $model = StudyRequest::class;

    public function definition(): array
    {
        return [
            'subject' => $this->faker->randomElement(['Math','Programming','Networks']),
            'course' => $this->faker->randomElement(['CS','IT','SE']),
            'level' => $this->faker->randomElement(['Year 1','Year 2','Year 3']),
            'description' => $this->faker->sentence(),
        ];
    }
}
