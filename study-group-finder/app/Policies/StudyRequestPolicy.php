<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StudyRequest;

class StudyRequestPolicy
{
    /**
     * Determine if the authenticated user can update the study request.
     */
    public function update(User $user, StudyRequest $request): bool
    {
        return $user->id === $request->user_id;
    }

    /**
     * Determine if the authenticated user can delete the study request.
     */
    public function delete(User $user, StudyRequest $request): bool
    {
        return $user->id === $request->user_id;
    }
}
