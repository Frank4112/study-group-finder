<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectRequest;
use App\Models\User;

class ProjectRequestsSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Web Development Team',
            'Mobile App Project',
            'Machine Learning Research',
            'Cyber Security Study Group',
            'Database Optimization Project',
            'Networking Lab Team',
            'AI Chatbot Project',
            'Cloud Computing Research',
            'Robotics Group',
            'Software Engineering Capstone'
        ];

        $skills = [
            'Python', 'Laravel', 'Django', 'Flutter', 'React',
            'Java', 'C++', 'MySQL', 'Networking', 'Cybersecurity'
        ];

        $locations = [
            'Library Room 5', 'Engineering Lab', 'ICT Basement',
            'Online (Google Meet)', 'Main Campus Auditorium'
        ];

        $users = User::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {

            // Safe random skill selection
            $skillCount = rand(1, 4);
            $selectedSkills = collect($skills)->random($skillCount)->implode(', ');

            ProjectRequest::create([
                'user_id'         => $users[array_rand($users)],
                'title'           => $titles[array_rand($titles)],
                'description'     => fake()->paragraph(),
                'required_skills' => $selectedSkills,
                'status'          => ['open', 'closed'][rand(0, 1)],
                'location'        => $locations[array_rand($locations)],
                'meeting_time'    => now()->addDays(rand(1, 10))->setTime(rand(8, 17), 0),
                'max_members'     => rand(2, 8),
            ]);
        }
    }
}
