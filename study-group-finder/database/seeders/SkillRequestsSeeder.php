<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SkillRequest;
use App\Models\User;

class SkillRequestsSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            'Python',
            'Laravel',
            'C++',
            'System Analysis',
            'Networking',
            'Database Management',
            'AI & ML',
            'Mobile App Development',
        ];

        $users = User::all();

        if ($users->count() === 0) {
            $this->command->error('No users exist. Seed users first.');
            return;
        }

        foreach ($users as $user) {
            SkillRequest::create([
                'user_id'    => $user->id,
                'skill_name' => $skills[array_rand($skills)],
                'experience' => rand(1, 10) . ' months',
                'details'    => 'Looking for someone to collaborate and improve skills.',
                'is_urgent'  => rand(0, 1),
                'description'=> 'Need urgent help on a project topic or assignment.',
            ]);
        }

        $this->command->info('Skill Requests seeded successfully.');
    }
}
