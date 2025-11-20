<?php

namespace App\Http\Controllers;

use App\Models\StudyRequest;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudyRequestController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return StudyRequest::with('user')->paginate(10);
    }

    public function store(StoreStudyRequest $request)
    {
        $data = $request->validated();

        StudyRequest::create([
            'course_name'    => $data['course_name'],
            'topic'          => $data['topic'],
            'message'        => $data['message'] ?? null,
            'user_id'        => Auth::user()->id, // if migration has this
            'preferred_time' => $data['preferred_time'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Study request created successfully.');
    }

    public function update(UpdateStudyRequest $request, StudyRequest $studyRequest)
    {
        $data = $request->validated();

        $studyRequest->update($data);

        return redirect()->back()->with('success', 'Study request updated successfully.');
    }

    public function destroy(StudyRequest $studyRequest)
    {
        // ensure only owner can delete
        $this->authorize('delete', $studyRequest);

        $studyRequest->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
