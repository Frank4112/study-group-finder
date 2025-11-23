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
        $skillRequests = SkillRequest::with(['user', 'skill'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('skill_requests.index', compact('skillRequests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'message'  => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $skillRequest = SkillRequest::create($validated);

        return redirect()->back()->with('success', 'Skill request submitted.');
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

        return redirect()->back()->with('success', 'Skill request deleted.');
    }
}
