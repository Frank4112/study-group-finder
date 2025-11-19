<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    public function run()
    {
        $skills = ['PHP','Laravel','JavaScript','HTML','CSS','Python','Django'];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
