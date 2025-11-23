<?php

namespace App\Http\Controllers;

use App\Models\StudyGroup;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Show "Messages" page:
     * lists all study groups the user belongs to,
     * showing last message in each group.
     */
    public function index()
    {
        $user = Auth::user();

        // All groups where user is a member
        $groups = $user->studyGroups()
            ->with([
                'messages' => function ($q) {
                    $q->latest()->limit(1);
                },
                'messages.user',
            ])
            ->get();

        return view('messages.index', compact('groups'));
    }

    /**
     * Store a new message in a study group chat.
     */
    public function store(Request $request, StudyGroup $studyGroup)
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Ensure only members can post (optional, but recommended)
        if (! $studyGroup->users->contains(Auth::id())) {
            return back()->with('error', 'You must join the group to send messages.');
        }

        Message::create([
            'study_group_id' => $studyGroup->id,
            'sender_id'      => Auth::id(),
            'body'           => $data['body'],
        ]);

        // Gamification: +1 point per message
        Auth::user()?->incrementPoints(1);

        return back()->with('success', 'Message sent.');
    }
}
