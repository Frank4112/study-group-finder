<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProjectRequest;

class ProjectRequestPolicy
{
    /**
     * Determine if the authenticated user can update the project request.
     */
    public function update(User $user, ProjectRequest $request): bool
    {
        return $user->id === $request->user_id;
    }

    /**
     * Determine if the authenticated user can delete the project request.
     */
    public function delete(User $user, ProjectRequest $request): bool
    {
        return $user->id === $request->user_id;
    }
}
