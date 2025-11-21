@extends('layouts.admin')

@section('title', 'Study Requests')
@section('page-title', 'Study Requests')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">All Study Requests</h2>
        <a href="{{ route('study_requests.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Request</a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Subject</th>
                <th class="border px-4 py-2">Level</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Location</th>
                <th class="border px-4 py-2">Preferred Time</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studyRequests ?? [] as $request)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $request->user->name }}</td>
                <td class="border px-4 py-2">{{ $request->subject }}</td>
                <td class="border px-4 py-2">{{ ucfirst($request->level) }}</td>
                <td class="border px-4 py-2">{{ $request->description }}</td>
                <td class="border px-4 py-2">{{ $request->location }}</td>
                <td class="border px-4 py-2">{{ $request->preferred_time }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('study_requests.edit', $request->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                    <form action="{{ route('study_requests.destroy', $request->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $studyRequests->links() }}
    </div>
</div>
@endsection
