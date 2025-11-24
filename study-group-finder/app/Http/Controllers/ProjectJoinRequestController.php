<?php

namespace App\Http\Controllers;

use App\Models\ProjectJoinRequest;
use App\Models\ProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectJoinRequestController extends Controller
{
    // User requests to join a project group
    public function store(ProjectRequest $projectRequest)
    {
        // Prevent duplicates
        if (ProjectJoinRequest::where('project_request_id', $projectRequest->id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->exists()) {
            return back()->with('error', 'You already sent a join request.');
        }

        ProjectJoinRequest::create([
            'project_request_id' => $projectRequest->id,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Join request submitted.');
    }

    // Project owner accepts
    public function accept(ProjectJoinRequest $joinRequest)
    {
        $project = $joinRequest->projectRequest;

        // Only owner can accept
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        // Update status
        $joinRequest->update(['status' => 'accepted']);

        // Add user to group (you may need to adjust this based on your project group structure)
        $project->group->users()->syncWithoutDetaching([$joinRequest->user_id]);

        return back()->with('success', 'User added to project group.');
    }

    // Reject join request
    public function reject(ProjectJoinRequest $joinRequest)
    {
        $project = $joinRequest->projectRequest;

        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $joinRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Join request rejected.');
    }
}
