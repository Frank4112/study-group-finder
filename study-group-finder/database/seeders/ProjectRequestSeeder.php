<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProjectRequest;

class ProjectRequestSeeder extends Seeder
{
    public function run()
    {
        foreach (User::all() as $user) {
            ProjectRequest::factory()->count(2)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
