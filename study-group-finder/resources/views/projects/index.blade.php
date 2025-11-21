@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">All Projects</h2>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Project</a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Created By</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects ?? [] as $project)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $project->id }}</td>
                <td class="border px-4 py-2">{{ $project->title }}</td>
                <td class="border px-4 py-2">{{ $project->description }}</td>
                <td class="border px-4 py-2">{{ $project->creator->name ?? 'N/A' }}</td>
                <td class="border px-4 py-2">
                    @if($project->status === 'active')
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Active</span>
                    @else
                        <span class="bg-gray-500 text-white px-2 py-1 rounded text-xs">{{ ucfirst($project->status) }}</span>
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>
@endsection
