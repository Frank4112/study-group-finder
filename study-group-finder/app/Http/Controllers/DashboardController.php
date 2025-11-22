<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudyRequest;
use App\Models\ProjectRequest;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    public function __construct()
    {
        // Only logged-in users can access dashboard
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // Adjust model names if yours are different
        $myProjectsCount = ProjectRequest::where('user_id', $user->id)->count();
        $myStudiesCount  = StudyRequest::where('user_id', $user->id)->count();

        return view('dashboard', [
            'user'            => $user,
            'myProjectsCount' => $myProjectsCount,
            'myStudiesCount'  => $myStudiesCount,
        ]);
    }
}
