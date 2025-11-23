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
    public function myGroups()
{
    $groups = auth()->user()
        ->studyGroups()
        ->with('creator')
        ->withCount('members')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('study_groups.my_groups', compact('groups'));
}

    
}
