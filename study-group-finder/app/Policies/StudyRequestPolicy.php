<?php

namespace App\Policies;

use App\Models\StudyRequest;
use App\Models\User;

class StudyRequestPolicy
{
    /**
     * Allow anyone (even guests) to view the list.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Allow anyone (even guests) to view a study request.
     */
    public function view(?User $user, StudyRequest $studyRequest): bool
    {
        return true;
    }

    /**
     * Only authenticated users can create a study request.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Only the owner can update.
     */
    public function update(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }

    /**
     * Only the owner can delete.
     */
    public function delete(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }
}
