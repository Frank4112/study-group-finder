<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SkillRequest;

class SkillRequestsSeeder extends Seeder
{
    public function run(): void
    {
        // Get first 5 users
        $users = User::take(5)->get();

        // If not enough users, stop
        if ($users->count() < 5) {
            $this->command->info('Not enough users in the database. Seed some users first.');
            return;
        }

        // Define skill requests
        $requests = [
            ['skill_name' => 'Mathematics', 'experience' => 'basic', 'details' => 'Need help with integrals', 'is_urgent' => true],
            ['skill_name' => 'French', 'experience' => 'basic', 'details' => 'Struggling with conjugation', 'is_urgent' => false],
            ['skill_name' => 'Physics', 'experience' => 'intermediate', 'details' => 'Understanding thermodynamics', 'is_urgent' => true],
            ['skill_name' => 'History', 'experience' => 'basic', 'details' => 'Preparing for exams', 'is_urgent' => false],
            ['skill_name' => 'Music', 'experience' => 'none', 'details' => 'Learn basic music theory', 'is_urgent' => false],
        ];

        // Seed the skill requests
        foreach ($requests as $index => $req) {
            SkillRequest::create(array_merge($req, ['user_id' => $users[$index]->id]));
        }

        $this->command->info('Skill requests seeded successfully.');
    }
}
