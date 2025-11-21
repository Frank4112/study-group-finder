<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@school.com',
            'password' => Hash::make('password123'),
            'major' => 'General Studies',
            'year_of_study' => 0, // 0 or 1 for admin
        ]);

        $students = [
            ['name' => 'Sarah Mwangi', 'email' => 'sarah.mwangi@example.com', 'major' => 'Mathematics', 'year' => 1],
            ['name' => 'Brian Otieno', 'email' => 'brian.otieno@example.com', 'major' => 'Physics', 'year' => 2],
            ['name' => 'Amina Khalid', 'email' => 'amina.khalid@example.com', 'major' => 'Chemistry', 'year' => 3],
            ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'major' => 'Biology', 'year' => 1],
            ['name' => 'Grace Wanjiru', 'email' => 'grace.wanjiru@example.com', 'major' => 'English', 'year' => 2],
            ['name' => 'Kevin Kimani', 'email' => 'kevin.kimani@example.com', 'major' => 'History', 'year' => 3],
            ['name' => 'Liam Brooks', 'email' => 'liam.brooks@example.com', 'major' => 'Geography', 'year' => 1],
            ['name' => 'Elena Cruz', 'email' => 'elena.cruz@example.com', 'major' => 'Art', 'year' => 2],
            ['name' => 'Samuel Kariuki', 'email' => 'samuel.kariuki@example.com', 'major' => 'Music', 'year' => 3],
            ['name' => 'Faith Cherono', 'email' => 'faith.cherono@example.com', 'major' => 'Economics', 'year' => 1],
            ['name' => 'Hannah Njeri', 'email' => 'hannah.njeri@example.com', 'major' => 'Business Studies', 'year' => 2],
            ['name' => 'David Kiptoo', 'email' => 'david.kiptoo@example.com', 'major' => 'French', 'year' => 3],
            ['name' => 'Maria Fernandes', 'email' => 'maria.fernandes@example.com', 'major' => 'Spanish', 'year' => 1],
            ['name' => 'Paul Ochieng', 'email' => 'paul.ochieng@example.com', 'major' => 'Computer Science', 'year' => 2],
            ['name' => 'Alice Muthoni', 'email' => 'alice.muthoni@example.com', 'major' => 'Sociology', 'year' => 3],
            ['name' => 'Michael Kamau', 'email' => 'michael.kamau@example.com', 'major' => 'Philosophy', 'year' => 1],
            ['name' => 'Rachel Nyambura', 'email' => 'rachel.nyambura@example.com', 'major' => 'Political Science', 'year' => 2],
            ['name' => 'George Muiruri', 'email' => 'george.muiruri@example.com', 'major' => 'Psychology', 'year' => 3],
            ['name' => 'Nancy Moraa', 'email' => 'nancy.moraa@example.com', 'major' => 'Environmental Science', 'year' => 1],
            ['name' => 'Peter Kibet', 'email' => 'peter.kibet@example.com', 'major' => 'Media Studies', 'year' => 2],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password123'),
                'major' => $student['major'],
                'year_of_study' => $student['year'],
            ]);
        }
    }
}
