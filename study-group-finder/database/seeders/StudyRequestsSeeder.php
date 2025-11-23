<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyRequest;
use App\Models\User;

class StudyRequestsSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Database Systems', 'Operating Systems', 'Computer Networks',
            'Algorithms', 'Software Engineering', 'Machine Learning',
            'Artificial Intelligence', 'Cyber Security', 'Web Development',
            'Mobile App Development'
        ];

        $courses = [
            'Computer Science',
            'Information Technology',
            'Software Engineering'
        ];

        $levels = ['first_year', 'second_year', 'third_year', 'fourth_year'];

        $locations = [
            'Library', 'Main Hall', 'Lab 3', 'Science Block', 'Online (Zoom)'
        ];

        // Get all user IDs once
        $users = User::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            StudyRequest::create([
                'user_id'        => $users[array_rand($users)],
                'subject'        => $subjects[array_rand($subjects)],
                'course'         => $courses[array_rand($courses)],
                'level'          => $levels[array_rand($levels)],
                'description'    => fake()->paragraph(),     // FIXED
                'location'       => $locations[array_rand($locations)],
                'preferred_time' => now()->addDays(rand(1, 14))->setTime(rand(8, 18), 0),
            ]);
        }
    }
}
