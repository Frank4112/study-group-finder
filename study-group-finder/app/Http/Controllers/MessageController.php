<?php

namespace App\Http\Controllers;

use App\Models\StudyGroup;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function store(Request $request, StudyGroup $studyGroup)
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Message::create([
            'study_group_id' => $studyGroup->id,
            'user_id'        => Auth::id(),
            'body'           => $data['body'],
        ]);

        Auth::user()?->incrementPoints(1);

        return back()->with('success', 'Message sent.');
    }
}
