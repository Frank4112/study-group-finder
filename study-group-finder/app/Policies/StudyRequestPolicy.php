<?php

namespace App\Policies;

use App\Models\StudyRequest;
use App\Models\User;

class StudyRequestPolicy
{
    public function update(User $user, StudyRequest $studyRequest): bool
    {
        return $user->id === $studyRequest->user_id;
    }

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
