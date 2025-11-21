<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use Carbon\Carbon;

class SkillsSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: clear the skills table if you want fresh data
        // Skill::truncate(); // Only if you want to delete all existing skills

        $skills = [
            ['name' => 'Mathematics', 'description' => 'Algebra, Calculus, Statistics'],
            ['name' => 'Physics', 'description' => 'Mechanics, Thermodynamics, Optics'],
            ['name' => 'Chemistry', 'description' => 'Organic, Inorganic, Physical Chemistry'],
            ['name' => 'Biology', 'description' => 'Botany, Zoology, Anatomy'],
            ['name' => 'English', 'description' => 'Grammar, Literature, Writing Skills'],
            ['name' => 'History', 'description' => 'World History, Local History'],
            ['name' => 'Geography', 'description' => 'Maps, Environment, Earth Science'],
            ['name' => 'Art', 'description' => 'Drawing, Painting, Design'],
            ['name' => 'Music', 'description' => 'Instruments, Singing, Theory'],
            ['name' => 'Economics', 'description' => 'Micro and Macro Economics'],
            ['name' => 'Business Studies', 'description' => 'Entrepreneurship, Management'],
            ['name' => 'French', 'description' => 'Language learning, Grammar, Vocabulary'],
            ['name' => 'Spanish', 'description' => 'Language learning, Grammar, Vocabulary'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']], // checks for existing skill by name
                [
                    'description' => $skill['description'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
