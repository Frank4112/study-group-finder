<?php

namespace App\Http\Controllers;

use App\Models\StudyRequest;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use App\Services\StudyMatchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudyRequestController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Main listing page — Livewire handles table.
     */
    public function index()
    {
        return view('study_requests.index');
    }

    /**
     * Show form for creating a study request.
     */
    public function create()
    {
        return view('study_requests.create');
    }

    /**
     * Store study request.
     */
    public function store(StoreStudyRequest $request)
    {
        $this->authorize('create', StudyRequest::class);

        $data = $request->validated();

        $studyRequest = StudyRequest::create([
            'subject'        => $data['subject'],
            'course'         => $data['course'],
            'level'          => $data['level'],
            'description'    => $data['description'] ?? null,
            'location'       => $data['location'] ?? null,
            'preferred_time' => $data['preferred_time'] ?? null,
            'user_id'        => Auth::id(),
        ]);

        // Gamification
        Auth::user()->incrementPoints(5);

        return redirect()
            ->route('study-requests.index')
            ->with('success', 'Study request created successfully.');
    }

    /**
     * View a single request.
     */
    public function show(StudyRequest $studyRequest)
    {
        $this->authorize('view', $studyRequest);

        return view('study_requests.show', compact('studyRequest'));
    }

    /**
     * Edit form.
     */
    public function edit(StudyRequest $studyRequest)
    {
        $this->authorize('update', $studyRequest);

        return view('study_requests.edit', compact('studyRequest'));
    }

    /**
     * Update request.
     */
    public function update(UpdateStudyRequest $request, StudyRequest $studyRequest)
    {
        $this->authorize('update', $studyRequest);

        $studyRequest->update($request->validated());

        return redirect()
            ->route('study-requests.index')
            ->with('success', 'Study request updated successfully.');
    }

    /**
     * Delete request.
     */
    public function destroy(StudyRequest $studyRequest)
    {
        $this->authorize('delete', $studyRequest);

        $studyRequest->delete();

        return redirect()
            ->route('study-requests.index')
            ->with('success', 'Study request deleted.');
    }

    /**
     * Match + group creation.
     */
    public function createGroupFromMatches(StudyRequest $studyRequest, StudyMatchService $matcher)
    {
        $this->authorize('view', $studyRequest);

        $group = $matcher->createGroupFromRequest($studyRequest);

        if (!$group) {
            return back()->with('error', 'Not enough matching requests to create a study group.');
        }

        return redirect()
            ->route('study-groups.show', $group->id)
            ->with('success', 'Study group created successfully.');
    }
}

