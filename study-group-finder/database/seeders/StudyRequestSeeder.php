<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudyRequest;

class StudyRequestSeeder extends Seeder
{
    public function run()
    {
        foreach (User::all() as $user) {
            StudyRequest::factory()->count(2)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
