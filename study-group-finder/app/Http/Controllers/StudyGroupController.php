<?php

namespace App\Http\Controllers;

use App\Models\StudyGroup;
use Illuminate\Support\Facades\Auth;


class StudyGroupController extends Controller
{
    public function index()
    {
        $groups = StudyGroup::with('creator')
            ->withCount('members')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('study_groups.index', compact('groups'));
    }

    public function show(StudyGroup $studyGroup)
    {
        $studyGroup->load(['creator', 'users', 'messages.user']);

        return view('study_groups.show', compact('studyGroup'));
    }

    public function join(StudyGroup $studyGroup)
    {
        $user = Auth::user();

        $studyGroup->users()->syncWithoutDetaching([$user->id]);
        $user->incrementPoints(3);

        return back()->with('success', 'You joined the study group.');
    }

    public function leave(StudyGroup $studyGroup)
    {
        $user = Auth::user();

        $studyGroup->users()->detach($user->id);

        return back()->with('success', 'You left the study group.');
    }

    public function destroy(StudyGroup $studyGroup)
{
    // Only the creator can delete the group
    if ($studyGroup->creator_id !== Auth::id()) {
        return back()->with('error', 'Only the group creator can delete this group.');
    }

    // Delete the group
    $studyGroup->delete();

    return redirect()
        ->route('study-groups.index')
        ->with('success', 'Study group deleted successfully.');
}


    public function myGroups()
{
    $user = Auth::user();
    $groups = $user 
        ->studyGroups()
        ->with('creator')
        ->withCount('members')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('study_groups.my_groups', compact('groups'));
}

    
}
