<?php

namespace Database\Factories;

use App\Models\ProjectRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRequestFactory extends Factory
{
    protected $model = ProjectRequest::class;

    public function definition(): array
    {
        return [
            'project_title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'required_skills' => 'Laravel,PHP',
            'difficulty_level' => $this->faker->randomElement(['Easy','Medium','Hard']),
        ];
    }
}
