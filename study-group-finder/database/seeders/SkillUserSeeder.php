<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Skill;

class SkillUserSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: clear pivot table
        DB::table('skill_user')->truncate();

        // Get first 5 users and skills
        $users = User::take(5)->get();
        $skills = Skill::take(5)->get();

        foreach ($users as $index => $user) {
            $skill = $skills[$index % $skills->count()];
            DB::table('skill_user')->insert([
                'user_id' => $user->id,
                'skill_id' => $skill->id,
            ]);
        }

        $this->command->info('Skill-User pivot table seeded successfully.');
    }
}
