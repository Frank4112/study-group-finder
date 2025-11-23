<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display all project requests
    public function index()
    {
        $projectRequests = ProjectRequest::with('user')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('project_requests.index', compact('projectRequests'));
    }

    // Show create form
    public function create()
    {
        return view('project_requests.create');
    }

    // Store a new project request
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        ProjectRequest::create($data);

        return redirect()->route('project-requests.index')
                         ->with('success', 'Project request created successfully.');
    }

    // Show a single project request
    public function show(ProjectRequest $projectRequest)
    {
        return view('project_requests.show', compact('projectRequest'));
    }

    // Delete a project request
    public function destroy(ProjectRequest $projectRequest)
    {
        // Only owner can delete
        if (Auth::id() !== $projectRequest->user_id) {
            abort(403);
        }

        $projectRequest->delete();

        return redirect()->route('project-requests.index')
                         ->with('success', 'Project request deleted successfully.');
    }

    // Like / Accept a project request

public function like(ProjectRequest $projectRequest)
{
    $user = Auth::user();

    if ($projectRequest->likedBy($user)) {
        // Unaccept: remove like and deduct points
        $projectRequest->likes()->detach($user->id);
        $user->decrement('points', 5); // adjust points as needed

        return redirect()->back()->with('success', 'Project request unaccepted, points removed.');
    }

    // Accept: add like and give points
    $projectRequest->likes()->attach($user->id);
    $user->increment('points', 5);

    return redirect()->back()->with('success', 'Project request accepted, points added!');
}

}

