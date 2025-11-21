<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ProjectRequest;

class ProjectUserSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: clear pivot table
        DB::table('project_user')->truncate();

        // Get first 5 users and project requests
        $users = User::take(5)->get();
        $projects = ProjectRequest::take(5)->get();

        foreach ($projects as $index => $project) {
            $user = $users[$index % $users->count()];
            DB::table('project_user')->insert([
                'project_request_id' => $project->id,
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('ProjectUser pivot table seeded successfully.');
    }
}

