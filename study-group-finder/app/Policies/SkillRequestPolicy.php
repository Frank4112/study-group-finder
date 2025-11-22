<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SkillRequest;

class SkillRequestPolicy
{
    public function update(User $user, SkillRequest $req): bool
    {
        return $user->id === $req->user_id;
    }

    public function delete(User $user, SkillRequest $req): bool
    {
        return $user->id === $req->user_id;
    }
}
