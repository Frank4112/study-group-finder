<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            ['name' => 'Python', 'description' => 'Python programming fundamentals'],
            ['name' => 'Laravel', 'description' => 'Laravel framework and MVC'],
            ['name' => 'JavaScript', 'description' => 'Frontend scripting'],
            ['name' => 'MySQL', 'description' => 'Database design and SQL'],
            ['name' => 'AI & Machine Learning', 'description' => 'ML models and data training'],
            ['name' => 'C++', 'description' => 'Systems programming'],
            ['name' => 'Java', 'description' => 'Object-oriented programming'],
            ['name' => 'React', 'description' => 'Frontend component UI development'],
        ];

        foreach ($skills as $s) {
            Skill::firstOrCreate(['name' => $s['name']], $s);
        }
    }
}
