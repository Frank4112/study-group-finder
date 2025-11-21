<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectRequest;
use App\Models\Skill;

class ProjectSkillSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: clear existing pivot entries
        DB::table('project_skill')->truncate();

        // Map project titles to skill names
        $projectSkillMap = [
            'Math Study Group' => ['Mathematics'],
            'Physics Project' => ['Physics'],
            'History Revision' => ['History'],
            'Chemistry Lab Group' => ['Chemistry'],
            'English Essay Group' => ['English'],
        ];

        foreach ($projectSkillMap as $projectTitle => $skills) {

            // Get the project request by title
            $project = ProjectRequest::where('title', $projectTitle)->first();

            if (!$project) {
                $this->command->warn("Project request '{$projectTitle}' not found. Skipping.");
                continue;
            }

            foreach ($skills as $skillName) {
                $skill = Skill::where('name', $skillName)->first();

                if (!$skill) {
                    $this->command->warn("Skill '{$skillName}' not found. Skipping.");
                    continue;
                }

                DB::table('project_skill')->insert([
                    'project_request_id' => $project->id,
                    'skill_id' => $skill->id,
                ]);
            }
        }

        $this->command->info('ProjectRequest-Skill pivot table seeded successfully.');
    }
}
