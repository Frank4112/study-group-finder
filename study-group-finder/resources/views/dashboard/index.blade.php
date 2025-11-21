@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Study Partner Finder Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Total Users Card -->
    <div class="bg-blue-500 text-white rounded-lg shadow p-5">
        <div class="text-sm font-semibold">Total Users</div>
        <div class="text-2xl font-bold">{{ $totalUsers ?? 0 }}</div>
    </div>

    <!-- Active Study Requests Card -->
    <div class="bg-green-500 text-white rounded-lg shadow p-5">
        <div class="text-sm font-semibold">Active Study Requests</div>
        <div class="text-2xl font-bold">{{ $activeStudyRequests ?? 0 }}</div>
    </div>

    <!-- Active Projects Card -->
    <div class="bg-purple-500 text-white rounded-lg shadow p-5">
        <div class="text-sm font-semibold">Active Projects</div>
        <div class="text-2xl font-bold">{{ $activeProjects ?? 0 }}</div>
    </div>

</div>

<!-- Recent Study Requests Table -->
<div class="mt-8 bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Recent Study Requests</h2>
    <table class="min-w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">User</th>
                <th class="border px-4 py-2 text-left">Subject</th>
                <th class="border px-4 py-2 text-left">Level</th>
                <th class="border px-4 py-2 text-left">Urgency</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentRequests ?? [] as $request)
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2">{{ $request->user->name }}</td>
                <td class="border px-4 py-2">{{ $request->subject }}</td>
                <td class="border px-4 py-2">{{ ucfirst($request->level) }}</td>
                <td class="border px-4 py-2">
                    @if($request->is_urgent)
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Urgent</span>
                    @else
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Normal</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
