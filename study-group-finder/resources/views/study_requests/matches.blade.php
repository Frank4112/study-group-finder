@extends('adminlte::page')

@section('title', 'Study Partner Matches')
@section('page-title', 'Potential Study Partners')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    <h2 class="text-xl font-semibold mb-4">
        Matches for: {{ $studyRequest->subject }} ({{ ucfirst(str_replace('_',' ',$studyRequest->level)) }})
    </h2>

    <a href="{{ route('study-requests.index') }}" 
       class="text-blue-600 underline mb-4 inline-block">
        ← Back to Study Requests
    </a>

    @if($matches->count() === 0)
        <p class="text-gray-600">No suitable matches were found.</p>
    @else

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Subject</th>
                <th class="border px-4 py-2">Course</th>
                <th class="border px-4 py-2">Level</th>
                <th class="border px-4 py-2">Location</th>
                <th class="border px-4 py-2">Preferred Time</th>
                <th class="border px-4 py-2">Match Score</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($matches as $m)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $m->user->name }}</td>
                <td class="border px-4 py-2">{{ $m->subject }}</td>
                <td class="border px-4 py-2">{{ $m->course }}</td>
                <td class="border px-4 py-2">{{ ucfirst(str_replace('_',' ',$m->level)) }}</td>
                <td class="border px-4 py-2">{{ $m->location }}</td>
                <td class="border px-4 py-2">{{ $m->preferred_time }}</td>
                <td class="border px-4 py-2 font-bold text-green-700">
                    {{ $m->match_score }}%
                </td>
                <td class="border px-4 py-2">
                    <form action="{{ route('study-requests.send-match-request', [$studyRequest->id, $m->id]) }}" method="POST">
                        @csrf
                        <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Send Match Request
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif

</div>
@endsection
