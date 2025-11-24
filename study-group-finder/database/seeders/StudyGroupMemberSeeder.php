<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyGroup;
use App\Models\User;
use App\Models\StudyGroupMember;

class StudyGroupMemberSeeder extends Seeder
{
    public function run()
    {
        $groups = StudyGroup::with('users')->get();
        $users  = User::pluck('id')->toArray();

        foreach ($groups as $group) {
            
            $current = $group->users()->count();

            if ($current >= 5) {
                continue;
            }

            $needed = 5 - $current;

            $newUsers = collect($users)
                ->diff($group->users->pluck('id'))
                ->shuffle()
                ->take($needed);

            foreach ($newUsers as $id) {
                StudyGroupMember::create([
                    'study_group_id' => $group->id,
                    'user_id' => $id
                ]);
            }
        }
    }
}
