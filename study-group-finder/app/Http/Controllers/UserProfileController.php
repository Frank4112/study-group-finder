<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function edit()
    {
        $profile = Auth::user()->profile;
        return view('profile.study-profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'learning_style'      => 'nullable|string',
            'preferred_mode'      => 'nullable|string',
            'preferred_time_slot' => 'nullable|string',
            'strengths'           => 'nullable|string',
            'weaknesses'          => 'nullable|string',
        ]);

        $profile = Auth::user()->profile;

        if ($profile) {
            $profile->update($data);
        } else {
            $data['user_id'] = Auth::id();
            UserProfile::create($data);
        }

        return back()->with('success', 'Study profile updated.');
    }
}
