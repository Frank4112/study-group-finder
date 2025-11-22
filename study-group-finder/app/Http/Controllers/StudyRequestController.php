<?php

namespace App\Http\Controllers;

use App\Models\StudyRequest;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Routing\Controller as BaseController;

class StudyRequestController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return StudyRequest::with('user')->paginate(10);
    }

    public function store(StoreStudyRequest $request)
    {
        $this->authorize('create', StudyRequest::class);

        $data = $request->validated();

        StudyRequest::create([
            'course_name'    => $data['course_name'],
            'topic'          => $data['topic'],
            'message'        => $data['message'] ?? null,
            'preferred_time' => $data['preferred_time'] ?? null,
            'user_id'        => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Study request created successfully.');
    }

    public function edit(StudyRequest $studyRequest)
    {
        $this->authorize('update', $studyRequest);
        // return view(...)
    }

    public function update(UpdateStudyRequest $request, StudyRequest $studyRequest)
    {
        $this->authorize('update', $studyRequest);

        $data = $request->validated();
        $studyRequest->update($data);

        return redirect()->back()->with('success', 'Study request updated successfully.');
    }

    public function destroy(StudyRequest $studyRequest)
    {
        $this->authorize('delete', $studyRequest);

        $studyRequest->delete();

        return redirect()->back()->with('success', 'Study request deleted successfully.');
    }
}
