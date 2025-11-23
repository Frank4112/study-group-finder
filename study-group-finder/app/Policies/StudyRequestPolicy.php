<?php

namespace App\Policies;

use App\Models\StudyRequest;
use App\Models\User;

class StudyRequestPolicy
{
<<<<<<< HEAD
=======
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
>>>>>>> 12128b6b584caabd080280544b6408a18850395d
    public function update(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }

<<<<<<< HEAD
=======
    /**
     * Determine if the authenticated user can delete the study request.
     */
>>>>>>> 12128b6b584caabd080280544b6408a18850395d
    public function delete(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }
   public function view(User $user, StudyRequest $request)
    {
        // All authenticated users can view study requests
        return true;
    }

}
