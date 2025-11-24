<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use App\Models\ProjectJoinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectRequestsController extends Controller
{
    /**
     * Display a paginated list of project requests.
     */
    public function index()
    {
        $projects = ProjectRequest::with('user')
            ->latest()
            ->paginate(10);

        return view('project_requests.index', compact('projects'));
    }

    /**
     * Show form to create a project request.
     */
    public function create()
    {
        return view('project_requests.create');
    }

    /**
     * Store a new project request.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $project = ProjectRequest::create([
            'title'       => $data['title'],
            'category'    => $data['category'] ?? null,
            'description' => $data['description'],
            'user_id'     => Auth::id(),
        ]);

        return redirect()
            ->route('project-requests.index')
            ->with('success', 'Project request created successfully.');
    }

    /**
     * Display a single project request.
     */
    public function show(ProjectRequest $projectRequest)
    {
        $projectRequest->load([
            'user',
            'joinRequests.user',
        ]);

        return view('project_requests.show', compact('projectRequest'));
    }

    /**
     * Show form to edit a project request.
     */
    public function edit(ProjectRequest $projectRequest)
    {
        if ($projectRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('project_requests.edit', compact('projectRequest'));
    }

    /**
     * Update a project request.
     */
    public function update(Request $request, ProjectRequest $projectRequest)
    {
        if ($projectRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'nullable|string|max:255',
            'description' => 'required|string',
        ]);

        $projectRequest->update($data);

        return redirect()
            ->route('project-requests.show', $projectRequest->id)
            ->with('success', 'Project request updated successfully.');
    }

    /**
     * Delete a project request.
     */
    public function destroy(ProjectRequest $projectRequest)
    {
        if ($projectRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $projectRequest->delete();

        return redirect()
            ->route('project-requests.index')
            ->with('success', 'Project request deleted.');
    }

    /**
     * Like a project request.
     */
    public function like(ProjectRequest $projectRequest)
    {
        $user = Auth::user();

        if ($projectRequest->likes()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already liked this project.');
        }

        $projectRequest->likes()->create([
            'user_id' => $user->id
        ]);

        return back()->with('success', 'You liked this project.');
    }
}
