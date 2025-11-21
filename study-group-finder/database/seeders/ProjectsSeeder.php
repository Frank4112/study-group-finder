<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class ProjectsSeeder extends Seeder
{
    public function run(): void
    {
        // Get first 5 users
        $users = User::take(5)->get();

        if ($users->count() < 1) {
            $this->command->info('No users found. Seed users first.');
            return;
        }

        $projects = [
            [
                'title' => 'Math Study Group',
                'description' => 'Practice and solve calculus problems',
                'status' => 'active',
            ],
            [
                'title' => 'Physics Project',
                'description' => 'Thermodynamics experiments',
                'status' => 'active',
            ],
            [
                'title' => 'History Revision',
                'description' => 'Group to prepare for history exams',
                'status' => 'active',
            ],
        ];

        foreach ($projects as $index => $project) {
            $user = $users[$index % $users->count()]; // Assign projects to existing users in round-robin
            Project::updateOrCreate(
                [
                    'title' => $project['title'],
                    'created_by' => $user->id
                ],
                $project + ['created_by' => $user->id]
            );
        }

        $this->command->info('Projects seeded successfully.');
    }
}
