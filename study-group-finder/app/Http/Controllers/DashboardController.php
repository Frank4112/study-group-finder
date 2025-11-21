<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudyRequest;
use App\Models\ProjectRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeStudyRequests = StudyRequest::count();
        $activeProjects = ProjectRequest::count();
        $recentRequests = StudyRequest::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalUsers', 'activeStudyRequests', 'activeProjects', 'recentRequests'
        ));
    }
}
