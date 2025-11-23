<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectsSeeder extends Seeder
{
    public function run(): void
    {
        // Use random existing users
        $userIds = User::pluck('id')->toArray();

        $projects = [
            [
                'title' => 'Math Study Group',
                'description' => 'Group for advanced calculus work.',
                'category' => 'Mathematics',
            ],
            [
                'title' => 'Web Development Series',
                'description' => 'Learning Laravel, Vue, and APIs.',
                'category' => 'Web Development',
            ],
            [
                'title' => 'Database Research Project',
                'description' => 'Exploring SQL optimization techniques.',
                'category' => 'Databases',
            ],
            [
                'title' => 'AI & Machine Learning',
                'description' => 'Group for ML beginners and intermediate learners.',
                'category' => 'AI',
            ],
            [
                'title' => 'Cybersecurity Lab',
                'description' => 'Hands-on ethical hacking practice.',
                'category' => 'Cybersecurity',
            ],
        ];

        foreach ($projects as $proj) {
            Project::create([
                'user_id'     => $userIds[array_rand($userIds)], // FIXED
                'title'       => $proj['title'],
                'description' => $proj['description'],
                'category'    => $proj['category'],
            ]);
        }
    }
}
