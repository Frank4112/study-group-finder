@extends('layouts.sidebar')

@section('page-title', 'Edit Project Request')

@section('content')

<h2 class="text-xl font-semibold mb-4">Edit Project Request</h2>

<form method="POST" action="{{ route('project-requests.update', $projectRequest->id) }}" class="space-y-4 bg-white p-6 shadow rounded">
    @csrf @method('PUT')

    <div>
        <label class="font-semibold">Project Title</label>
        <input type="text" name="project_title" value="{{ $projectRequest->project_title }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 rounded">{{ $projectRequest->description }}</textarea>
    </div>

    <div>
        <label class="font-semibold">Required Skills</label>
        <input type="text" name="required_skills" value="{{ $projectRequest->required_skills }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="font-semibold">Difficulty</label>
        <select name="difficulty_level" class="w-full border p-2 rounded">
            <option {{ $projectRequest->difficulty_level == 'Easy' ? 'selected' : '' }}>Easy</option>
            <option {{ $projectRequest->difficulty_level == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option {{ $projectRequest->difficulty_level == 'Hard' ? 'selected' : '' }}>Hard</option>
        </select>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Update
    </button>

</form>

@endsection
