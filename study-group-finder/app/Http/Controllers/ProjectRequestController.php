<?php

namespace App\Http\Controllers;

use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectRequestController extends Controller
{
    public function index()
    {
        return ProjectRequest::with('user')->paginate(10);
    }

    public function store(StoreProjectRequest $request)
    {
        // safe validated input
        $data = $request->validated();

        // enforce logged-in user ID
        $data['user_id'] = auth()->id();

        return ProjectRequest::create($data);
    }

    public function update(UpdateProjectRequest $request, ProjectRequest $projectRequest)
    {
        // ensure only owner can update
        $this->authorize('update', $projectRequest);

        $projectRequest->update($request->validated());

        return $projectRequest;
    }

    public function destroy(ProjectRequest $projectRequest)
    {
        // ensure only owner can delete
        $this->authorize('delete', $projectRequest);

        $projectRequest->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
