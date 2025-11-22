@extends('layouts.sidebar')

@section('page-title', 'Create Project Request')

@section('content')

<h2 class="text-xl font-semibold mb-4">Create Project Request</h2>

<form method="POST" action="{{ route('project-requests.store') }}" class="space-y-4 bg-white p-6 shadow rounded">
    @csrf

    <div>
        <label class="font-semibold">Project Title</label>
        <input type="text" name="project_title" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 rounded"></textarea>
    </div>

    <div>
        <label class="font-semibold">Required Skills</label>
        <input type="text" name="required_skills" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="font-semibold">Difficulty</label>
        <select name="difficulty_level" class="w-full border p-2 rounded">
            <option>Easy</option>
            <option>Medium</option>
            <option>Hard</option>
        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Save
    </button>

</form>

@endsection
