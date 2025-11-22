<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyRequest;
use App\Models\User;
use Carbon\Carbon;

class StudyRequestsSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();

        if (count($users) == 0) {
            $this->command->info('No users found. Seed users first.');
            return;
        }

        // Updated CS-related subjects
        $subjects = [
            'Operating Systems', 'Database Systems', 'Computer Networks',
            'Data Structures', 'Algorithms', 'Software Engineering',
            'Discrete Mathematics', 'Web Development', 'Mobile Development',
            'Artificial Intelligence', 'Probability & Statistics',
            'System Analysis and Design', 'Compiler Construction',
            'Computer Architecture', 'Machine Learning Basics',
            'Cybersecurity', 'Human Computer Interaction', 'Cloud Computing',
            'Distributed Systems'
        ];

        // Updated levels for year-based study
        $levels = ['first_year', 'second_year', 'third_year', 'fourth_year'];

        $locations = [
            'Library', 'Lab A1', 'Online',
            'Classroom 3B', 'Hostel Study Room', 'Innovation Hub'
        ];

        $descriptions = [
            'Need help revising key concepts.',
            'Looking for someone to practice past papers with.',
            'Group revision session needed.',
            'Want to understand this unit better.',
            'Preparing for upcoming CAT.',
            'Need support with assignments.',
            'Looking for study partner to complete exercises.',
            'Want to discuss difficult topics.',
            'Preparing for final exams.',
            'Need help breaking down complex topics.',
        ];

        // Generate 60 random study requests
        for ($i = 0; $i < 60; $i++) {

            StudyRequest::create([
                'user_id'        => $users[array_rand($users)],
                'subject'        => $subjects[array_rand($subjects)],
                'course'         => 'Computer Science',
                'level'          => $levels[array_rand($levels)],
                'description'    => $descriptions[array_rand($descriptions)],
                'location'       => $locations[array_rand($locations)],
                'preferred_time' => Carbon::now()->addHours(rand(1, 72)),
            ]);
        }

        $this->command->info('60 Study Requests seeded successfully.');
    }
}
