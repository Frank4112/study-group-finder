<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProjectRequest;

class ProjectRequestsSeeder extends Seeder
{
    public function run(): void
    {
        // Get first 5 users
        $users = User::take(5)->get();

        if ($users->count() < 5) {
            $this->command->info('Not enough users in the database. Seed users first.');
            return;
        }

        $projects = [
            [
                'title' => 'Math Study Group',
                'description' => 'Group for Calculus I practice',
                'required_skills' => 'Mathematics',
                'status' => 'open',
            ],
            [
                'title' => 'Physics Project',
                'description' => 'Thermodynamics experiment',
                'required_skills' => 'Physics',
                'status' => 'open',
            ],
            [
                'title' => 'History Revision Group',
                'description' => 'Prepare for exams',
                'required_skills' => 'History',
                'status' => 'open',
            ],
            [
                'title' => 'Chemistry Lab Group',
                'description' => 'Organic chemistry practice',
                'required_skills' => 'Chemistry',
                'status' => 'open',
            ],
            [
                'title' => 'English Essay Group',
                'description' => 'Improve essay writing',
                'required_skills' => 'English',
                'status' => 'open',
            ],
        ];

        foreach ($projects as $index => $project) {
            ProjectRequest::updateOrCreate(
                [
                    'user_id' => $users[$index]->id,
                    'title' => $project['title']
                ],
                $project + ['user_id' => $users[$index]->id]
            );
        }

        $this->command->info('Project requests seeded successfully.');
    }
}

