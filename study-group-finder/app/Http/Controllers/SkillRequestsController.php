<?php

namespace App\Http\Controllers;

use App\Models\SkillRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SkillRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $skillRequests = \App\Models\SkillRequest::with('user')
                        ->orderBy('id', 'desc')
                        ->paginate(10);

    return view('skill_requests.index', compact('skillRequests'));
}
     public function create()
{
    // Optionally fetch skills for a dropdown
    $skills = \App\Models\Skill::all();
    return view('skill_requests.create', compact('skills'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'skill_name' => 'required|string',
        'experience' => 'nullable|string',
        'details' => 'nullable|string',
        'is_urgent' => 'nullable|boolean',
        'description' => 'nullable|string',
    ]);

    $data['user_id'] = auth()->id(); // Assign the logged-in user

    \App\Models\SkillRequest::create($data);

    return redirect()->route('skill-requests.index')
                     ->with('success', 'Skill request created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(SkillRequest $skillRequest)
    {
        return view('skill_requests.show', compact('skillRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkillRequest $skillRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $skillRequest->update($validated);

        return redirect()->back()->with('success', 'Status updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(SkillRequest $skillRequest)
{
    $skillRequest->delete();
    return redirect()->route('skill-requests.index')
                     ->with('success', 'Skill request deleted successfully!');
}

}
