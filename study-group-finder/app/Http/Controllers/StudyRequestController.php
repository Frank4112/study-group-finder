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
        $skills = \App\Models\Skill::all();
        return view('study_requests.create', compact('skills'));
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

        if ($request->has('skills')) {
    foreach ($request->input('skills') as $skillName) {
        \App\Models\SkillRequest::create([
            'user_id'    => Auth::id(),
            'skill_name' => $skillName,
            'experience' => $request->input("experience.$skillName"), // 1-4 years
            'details'    => $request->input('description') ?? null,
            'description'=> $request->input('description') ?? null,
        ]);
    }
}


        // Gamification
        Auth::user()->incrementPoints(5);

        // AUTO MATCHING + AUTO GROUP CREATION
        $group = $matcher->createGroupFromRequest($studyRequest);

        // If a group is formed successfully
       // AUTO MATCHING + AUTO GROUP CREATION
$group = $matcher->createGroupFromRequest($studyRequest);

// Only redirect if group exists AND contains at least 2 members
if ($group && $group->users()->count() > 1) {
    return redirect()
        ->route('study-requests.index')
        ->with('group_created', $group->id)
        ->with('success', 'Study request created successfully! A matching study group was created.');
}

// otherwise return normally
return redirect()
    ->route('study-requests.index')
    ->with('success', 'Study request created successfully!');

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
    //joining a group
    public function joinGroup(StudyRequest $studyRequest)
{
    $this->authorize('view', $studyRequest);

    $user = Auth::user();

    // Ensure request has a group
    if (! $studyRequest->group) {
        return back()->with('error', 'This study request is not linked to any study group.');
    }

    $group = $studyRequest->group;

    // Prevent duplicate joining
    if ($group->users()->where('user_id', $user->id)->exists()) {
        return back()->with('info', 'You are already a member of this study group.');
    }

    // Join the group
    $group->users()->attach($user->id);

    return back()->with('success', 'You have joined this study group successfully.');
}

}
