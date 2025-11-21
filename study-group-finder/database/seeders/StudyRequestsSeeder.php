<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudyRequest;
use Carbon\Carbon;

class StudyRequestsSeeder extends Seeder
{
    public function run(): void
    {
        // Get first 5 users
        $users = User::take(5)->get();

        if ($users->count() < 5) {
            $this->command->info('Not enough users in the database. Seed users first.');
            return;
        }

        // Study requests data
        $requests = [
            [
                'subject' => 'Calculus I',
                'level' => 'beginner',
                'description' => 'Practice derivatives and integrals',
                'location' => 'Online',
                'preferred_time' => Carbon::now()->addHours(18), // 6 PM today
            ],
            [
                'subject' => 'Physics',
                'level' => 'intermediate',
                'description' => 'Work on mechanics problems',
                'location' => 'Library',
                'preferred_time' => Carbon::now()->addHours(14), // 2 PM today
            ],
            [
                'subject' => 'History',
                'level' => 'beginner',
                'description' => 'Prepare for exams',
                'location' => 'Online',
                'preferred_time' => Carbon::now()->addHours(9), // 9 AM today
            ],
            [
                'subject' => 'Chemistry',
                'level' => 'beginner',
                'description' => 'Organic chemistry practice',
                'location' => 'Lab',
                'preferred_time' => Carbon::now()->addHours(15), // 3 PM today
            ],
            [
                'subject' => 'English',
                'level' => 'beginner',
                'description' => 'Essay writing help',
                'location' => 'Online',
                'preferred_time' => Carbon::now()->addHours(19), // 7 PM today
            ],
        ];

        // Seed study requests
        foreach ($requests as $index => $req) {
            StudyRequest::updateOrCreate(
                [
                    'user_id' => $users[$index]->id,
                    'subject' => $req['subject']
                ],
                $req + ['user_id' => $users[$index]->id]
            );
        }

        $this->command->info('Study requests seeded successfully.');
    }
}



