<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Skill;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ProjectRequestController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return ProjectRequest::with('user')->paginate(10);
    }

    public function store(StoreProjectRequest $request)
    {
        // safe validated input
        $data = $request->validated();

        $project = ProjectRequest::create([
            'title'        => $data['title'],
            'description'  => $data['description'],
            'location'     => $data['location'] ?? null,
            'meeting_time' => $data['meeting_time'] ?? null,
            'max_members'  => $data['max_members'] ?? null,
            'user_id'      => Auth::id(), // if column exists
        ]);

        if (!empty($data['skills'])) {
            $project->skills()->sync($data['skills']);
        }

        return redirect()->back()->with('success', 'Project created successfully.');
    }

    public function update(UpdateProjectRequest $request, ProjectRequest $projectRequest)
    {
        // ensure only owner can update
        $this->authorize('update', $projectRequest);

        $data = $request->validated();

        $projectRequest->update([
            'title'        => $data['title']        ?? $projectRequest->title,
            'description'  => $data['description']  ?? $projectRequest->description,
            'location'     => $data['location']     ?? $projectRequest->location,
            'meeting_time' => $data['meeting_time'] ?? $projectRequest->meeting_time,
            'max_members'  => $data['max_members']  ?? $projectRequest->max_members,
        ]);

        if (isset($data['skills'])) {
            $projectRequest->skills()->sync($data['skills']);
        }

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    public function destroy(ProjectRequest $projectRequest)
    {
        // ensure only owner can delete
        $this->authorize('delete', $projectRequest);

        $projectRequest->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
