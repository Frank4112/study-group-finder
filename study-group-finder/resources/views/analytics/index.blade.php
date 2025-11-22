@extends('layouts.admin')

@section('title', 'Analytics')
@section('page-title', 'Platform Analytics')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 space-y-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 bg-blue-50 rounded">
            <div class="text-sm text-gray-500">Total Study Requests</div>
            <div class="text-2xl font-bold">{{ $totalRequests }}</div>
        </div>
        <div class="p-4 bg-green-50 rounded">
            <div class="text-sm text-gray-500">Accepted Matches</div>
            <div class="text-2xl font-bold">{{ $totalMatches }}</div>
        </div>
        <div class="p-4 bg-yellow-50 rounded">
            <div class="text-sm text-gray-500">Registered Users</div>
            <div class="text-2xl font-bold">{{ \App\Models\User::count() }}</div>
        </div>
    </div>

    <div>
        <h3 class="font-semibold mb-2">Top Subjects</h3>
        <ul class="list-disc ml-5">
            @foreach($topSubjects as $subject)
                <li>{{ $subject->subject }} ({{ $subject->total }} requests)</li>
            @endforeach
        </ul>
    </div>

    <div>
        <h3 class="font-semibold mb-2">Top Users (by points)</h3>
        <ul class="list-disc ml-5">
            @foreach($topUsers as $user)
                <li>{{ $user->name }} - {{ $user->points }} pts (Level {{ $user->xp_level }})</li>
            @endforeach
        </ul>
    </div>

</div>
@endsection
