<?php

namespace App\Services;

use App\Models\StudyRequest;
use App\Models\StudyGroup;
use App\Models\StudyGroupMember;
use App\Models\User;

class StudyMatchService
{
    /**
     * Create a study group from a single request and auto-match compatible users.
     */
    public function createGroupFromRequest(StudyRequest $request, int $maxMembers = 5): ?StudyGroup
    {
        // Find matches: same subject, course, level
        $matches = StudyRequest::where('subject', $request->subject)
            ->where('course', $request->course)
            ->where('level', $request->level)
            ->where('id', '!=', $request->id)
            ->with('user')
            ->take($maxMembers)
            ->get();

        if ($matches->isEmpty()) {
            return null;
        }

        $group = StudyGroup::create([
            'name'       => $request->subject . ' - ' . ucfirst(str_replace('_', ' ', $request->level)) . ' Group',
            'subject'    => $request->subject,
            'course'     => $request->course,
            'level'      => $request->level,
            'creator_id' => $request->user_id,
        ]);

        // Add creator
        StudyGroupMember::create([
            'study_group_id' => $group->id,
            'user_id'        => $request->user_id,
        ]);

        // Add matches
        foreach ($matches as $m) {
            StudyGroupMember::firstOrCreate([
                'study_group_id' => $group->id,
                'user_id'        => $m->user_id,
            ]);

            // Optional: reward matched users
            $m->user?->incrementPoints(3);
        }

        // Gamify creator
        $request->user?->incrementPoints(5);

        return $group;
    }

    /**
     * Simple global matcher – scan recent study requests and group them.
     */
    public function runGlobalMatching(): int
    {
        $count = 0;

        $requests = StudyRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->take(200)
            ->get();

        $grouped = $requests->groupBy(function ($req) {
            return $req->subject . '|' . $req->course . '|' . $req->level;
        });

        foreach ($grouped as $key => $bucket) {
            if ($bucket->count() < 3) {
                continue;
            }

            // Check if group already exists for this combo
            [$subject, $course, $level] = explode('|', $key);
            $existing = StudyGroup::where('subject', $subject)
                ->where('course', $course)
                ->where('level', $level)
                ->first();

            if ($existing) {
                continue;
            }

            $first = $bucket->first();

            $group = StudyGroup::create([
                'name'       => $subject . ' - ' . ucfirst(str_replace('_', ' ', $level)) . ' Auto Group',
                'subject'    => $subject,
                'course'     => $course,
                'level'      => $level,
                'creator_id' => $first->user_id,
            ]);

            foreach ($bucket as $req) {
                StudyGroupMember::firstOrCreate([
                    'study_group_id' => $group->id,
                    'user_id'        => $req->user_id,
                ]);
            }

            $count++;
        }

        return $count;
    }
}
