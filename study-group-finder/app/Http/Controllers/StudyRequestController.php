<?php

namespace App\Http\Controllers;

use App\Models\StudyRequest;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;

class StudyRequestController extends Controller
{
    public function index()
    {
        return StudyRequest::with('user')->paginate(10);
    }

    public function store(StoreStudyRequest $request)
    {
        // safe validated data
        $data = $request->validated();

        // force the logged-in user ID
        $data['user_id'] = auth()->id();

        return StudyRequest::create($data);
    }

    public function update(UpdateStudyRequest $request, StudyRequest $studyRequest)
    {
        // ensure only owner can update
        $this->authorize('update', $studyRequest);

        $studyRequest->update($request->validated());

        return $studyRequest;
    }

    public function destroy(StudyRequest $studyRequest)
    {
        // ensure only owner can delete
        $this->authorize('delete', $studyRequest);

        $studyRequest->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
