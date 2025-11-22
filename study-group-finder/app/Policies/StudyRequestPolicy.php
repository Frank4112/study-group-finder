<?php

namespace App\Policies;

use App\Models\StudyRequest;
use App\Models\User;

class StudyRequestPolicy
{
    /**
     * Determine if the authenticated user can view any study requests.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine if the authenticated user can view the specific study request.
     */
    public function view(?User $user, StudyRequest $studyRequest): bool
    {
        return true;
    }

    /**
     * Determine if the authenticated user can create study requests.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the authenticated user can update the study request.
     */
    public function update(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }

    /**
     * Determine if the authenticated user can delete the study request.
     */
    public function delete(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }
}
