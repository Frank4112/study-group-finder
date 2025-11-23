<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudyRequest;
use App\Models\ProjectRequest;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalUsers' => User::count(),
            'activeStudyRequests' => StudyRequest::count(),
            'activeProjects' => ProjectRequest::count(),
            'recentRequests' => StudyRequest::with('user')
                                    ->latest()
                                    ->take(5)
                                    ->get(),
        ]);
    }
}
