<?php

namespace App\Http\Controllers;

use App\Models\StudyRequest;
use App\Http\Requests\StoreStudyRequest;
use App\Http\Requests\UpdateStudyRequest;
use App\Services\StudyMatchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class StudyRequestController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Main listing page — Livewire table handles rendering.
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
     * Store request + auto-match + auto-group creation.
     */
    public function store(StoreStudyRequest $request, StudyMatchService $matcher)
    {
        $this->authorize('create', StudyRequest::class);

        $data = $request->validated();

        // Save study request
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

        // AUTO MATCHING + AUTO GROUP CREATION
        $group = $matcher->createGroupFromRequest($studyRequest);

        // If a group is formed successfully
        if ($group) {
            return redirect()
                ->route('study-groups.show', $group->id)
                ->with('success', 'Study request created — matching study group was created automatically!');
        }

        // If no matching partners found
        return redirect()
            ->route('study-requests.index')
            ->with('success', 'Study request created — no matching partners yet.');
    }

    /**
     * View a specific request.
     */
    public function show(StudyRequest $studyRequest)
    {
        $this->authorize('view', $studyRequest);

        return view('study_requests.show', compact('studyRequest'));
    }

    /**
     * Show edit form.
     */
    public function edit(StudyRequest $studyRequest)
    {
        $this->authorize('update', $studyRequest);

        return view('study_requests.edit', compact('studyRequest'));
    }

    /**
     * Update study request.
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
     * Manual group creation from matches (optional).
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
