<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectRequestsController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $projectRequests = \App\Models\ProjectRequest::with(['user', 'skills'])->orderBy('id', 'desc')->paginate(10);
    return view('project_requests.index', compact('projectRequests'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', ProjectRequest::class);

        $data = $request->validated();

        $project = ProjectRequest::create([
            // adjust to your columns
            'title'       => $data['title'],
            'description' => $data['description'],
            'location'    => $data['location'] ?? null,
            'meeting_time'=> $data['meeting_time'] ?? null,
            'max_members' => $data['max_members'] ?? null,
            'user_id'     => \Illuminate\Support\Facades\Auth::user()->id,
        ]);

        if (!empty($data['skills'])) {
            $project->skills()->sync($data['skills']);
        }

        return redirect()->back()->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectRequest $projectRequest)
    {
        $this->authorize('update', $projectRequest);

        // return view with $projectRequest
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, ProjectRequest $projectRequest)
    {
        $this->authorize('update', $projectRequest);

        $data = $request->validated();
        $projectRequest->update($data);

        if (isset($data['skills'])) {
            $projectRequest->skills()->sync($data['skills']);
        }

        return redirect()->back()->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectRequest $projectRequest)
    {
        $this->authorize('delete', $projectRequest);

        $projectRequest->delete();

        return redirect()->back()->with('success', 'Project deleted successfully.');
    }
}
