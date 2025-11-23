@extends('adminlte::page')

@section('page-title', 'Project Requests')

@section('content')

<div class="bg-white shadow-md rounded-lg p-6">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">All Project Requests</h2>

        <a href="{{ route('project-requests.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Add Project Request
        </a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Skills</th>
                <th class="border px-4 py-2">Difficulty</th>
                <th class="border px-4 py-2">Created By</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($projectRequests as $project)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $project->id }}</td>
                <td class="border px-4 py-2">{{ $project->project_title }}</td>
                <td class="border px-4 py-2">{{ $project->required_skills }}</td>
                <td class="border px-4 py-2">{{ $project->difficulty_level }}</td>

                <td class="border px-4 py-2">
                    {{ $project->user->name ?? 'Unknown' }}
                </td>

                <td class="border px-4 py-2 flex gap-2">

                    <a href="{{ route('project-requests.show', $project->id) }}"
                       class="text-blue-600 hover:underline">
                        View
                    </a>

                    <a href="{{ route('project-requests.edit', $project->id) }}"
                       class="text-green-600 hover:underline">
                        Edit
                    </a>

                    <form action="{{ route('project-requests.destroy', $project->id) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600 hover:underline"
                                onclick="return confirm('Delete this request?')">
                            Delete
                        </button>

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
