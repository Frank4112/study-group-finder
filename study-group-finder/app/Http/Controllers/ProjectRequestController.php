<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class ProjectRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index – Livewire table
    public function index()
    {
        return view('project_requests.index');
    }

    // Create form
    public function create()
    {
        return view('project_requests.create');
    }

    // Store
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        ProjectRequest::create($data);

        Auth::user()?->incrementPoints(5);

        return redirect()
            ->route('project-requests.index')
            ->with('success', 'Project request created successfully.');
    }

    // Show
    public function show(ProjectRequest $projectRequest)
    {
        return view('project_requests.show', compact('projectRequest'));
    }

    // Edit form
    public function edit(ProjectRequest $projectRequest)
    {
        return view('project_requests.edit', compact('projectRequest'));
    }

    // Update
    public function update(UpdateProjectRequest $request, ProjectRequest $projectRequest)
    {
        $projectRequest->update($request->validated());

        return redirect()
            ->route('project-requests.index')
            ->with('success', 'Project request updated successfully.');
    }

    // Delete
    public function destroy(ProjectRequest $projectRequest)
    {
        $projectRequest->delete();

        return redirect()
            ->route('project-requests.index')
            ->with('success', 'Project request deleted.');
    }
}
