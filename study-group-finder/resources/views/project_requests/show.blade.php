@extends('layouts.sidebar')

@section('page-title', 'Project Request Details')

@section('content')

<div class="bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">{{ $projectRequest->project_title }}</h2>

    <p><strong>Description:</strong> {{ $projectRequest->description }}</p>
    <p><strong>Required Skills:</strong> {{ $projectRequest->required_skills }}</p>
    <p><strong>Difficulty:</strong> {{ $projectRequest->difficulty_level }}</p>

    <a href="{{ route('project-requests.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">
        Back to list
    </a>
</div>

@endsection
