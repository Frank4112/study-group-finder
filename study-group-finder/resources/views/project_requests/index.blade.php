@extends('layouts.admin')

@section('title', 'Project Requests')
@section('page-title', 'Project Requests')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">All Project Requests</h2>
        <a href="{{ route('project_requests.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Request</a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Required Skills</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projectRequests ?? [] as $request)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $request->user->name }}</td>
                <td class="border px-4 py-2">{{ $request->title }}</td>
                <td class="border px-4 py-2">{{ $request->description }}</td>
                <td class="border px-4 py-2">
                    @foreach($request->skills ?? [] as $skill)
                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-xs mr-1">{{ $skill->name }}</span>
                    @endforeach
                </td>
                <td class="border px-4 py-2">
                    @if($request->status === 'open')
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Open</span>
                    @else
                        <span class="bg-gray-500 text-white px-2 py-1 rounded text-xs">{{ ucfirst($request->status) }}</span>
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('project_requests.edit', $request->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                    <form action="{{ route('project_requests.destroy', $request->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $projectRequests->links() }}
    </div>
</div>
@endsection
