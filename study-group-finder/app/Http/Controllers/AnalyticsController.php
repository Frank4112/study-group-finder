<?php

namespace App\Http\Controllers;

use App\Models\StudyRequest;
use App\Models\StudyRequestMatch;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $totalRequests = StudyRequest::count();
        $totalMatches  = StudyRequestMatch::where('status', 'accepted')->count();
        $topSubjects   = StudyRequest::select('subject', DB::raw('count(*) as total'))
                            ->groupBy('subject')
                            ->orderByDesc('total')
                            ->take(5)
                            ->get();

        $topUsers = User::orderByDesc('points')->take(5)->get();

        return view('analytics.index', compact(
            'totalRequests',
            'totalMatches',
            'topSubjects',
            'topUsers'
        ));
    }
}
