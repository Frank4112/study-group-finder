<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudyGroup;
use App\Models\User;
use App\Models\StudyGroupMember;

class SeedStudyGroupMembers extends Command
{
    protected $signature = 'seed:group-members';
    protected $description = 'Fill each study group with random dummy members (max 5)';

    public function handle()
    {
        $groups = StudyGroup::with('users')->get();
        $users  = User::pluck('id')->toArray();

        foreach ($groups as $group) {

            $currentCount = $group->users()->count();

            if ($currentCount >= 5) {
                $this->info("Group {$group->id} already has {$currentCount} members. Skipping.");
                continue;
            }

            $needed = 5 - $currentCount;

            // Random users that are NOT already in group
            $newUsers = collect($users)
                ->diff($group->users()->pluck('user_id'))
                ->shuffle()
                ->take($needed);

            foreach ($newUsers as $userId) {
                StudyGroupMember::create([
                    'study_group_id' => $group->id,
                    'user_id'        => $userId,
                ]);
            }

            $this->info("Added {$needed} members to group {$group->id}.");
        }

        $this->info("DONE!");
    }
}
