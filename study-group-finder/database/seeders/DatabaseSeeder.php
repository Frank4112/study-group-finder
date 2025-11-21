<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        UsersSeeder::class,
        SkillsSeeder::class,
        SkillRequestsSeeder::class,
        StudyRequestsSeeder::class,
        ProjectRequestsSeeder::class,
        ProjectsSeeder::class,
        ProjectSkillSeeder::class,
        ProjectUserSeeder::class,
        SkillUserSeeder::class,
    ]);
}


}
