<?php

namespace App\Policies;

use App\Models\ProjectRequest;
use App\Models\User;

class ProjectRequestPolicy
{
    /**
     * Determine if the authenticated user can view any project requests.
     */
    public function viewAny(?User $user): bool
    {
        // anyone can list (or only logged in, if you want)
        return true;
    }

    /**
     * Determine if the authenticated user can view the project request.
     */
    public function view(?User $user, ProjectRequest $projectRequest): bool
    {
        // anyone can view, or restrict to owner if you prefer
        return true;
    }

    /**
     * Determine if the authenticated user can create a project request.
     */
    public function create(User $user): bool
    {
        // any logged-in user can create a project request
        return true;
    }

    /**
     * Determine if the authenticated user can update the project request.
     */
    public function update(User $user, ProjectRequest $projectRequest): bool
    {
        // only owner can update
        return $user->id === $projectRequest->user_id;
    }

    /**
     * Determine if the authenticated user can delete the project request.
     */
    public function delete(User $user, ProjectRequest $projectRequest): bool
    {
        // only owner can delete
        return $user->id === $projectRequest->user_id;
    }
}
