@extends('adminlte::page')

@section('title', 'Project Request Details')

@section('content_header')
    <h1>Project Request Details</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">{{ $projectRequest->title }}</h3>
    </div>

    <div class="card-body">
        <p><strong>Title:</strong> {{ $projectRequest->title }}</p>

        <p><strong>Description:</strong></p>
        <div class="border rounded p-3 bg-light mb-3">
            {{ $projectRequest->description ?? 'No description provided.' }}
        </div>

        <p><strong>Required Skills:</strong> {{ $projectRequest->required_skills ?? '-' }}</p>
        <p><strong>Max Members:</strong> {{ $projectRequest->max_members ?? '-' }}</p>
        <p><strong>Location:</strong> {{ $projectRequest->location ?? '-' }}</p>
        <p><strong>Meeting Time:</strong> 
            {{ $projectRequest->meeting_time ? \Carbon\Carbon::parse($projectRequest->meeting_time)->format('H:i') : '-' }}
        </p>

        <p><strong>Status:</strong> 
            <span class="badge {{ $projectRequest->status === 'open' ? 'badge-success' : 'badge-secondary' }}">
                {{ ucfirst($projectRequest->status) }}
            </span>
        </p>

        <p><strong>Owner:</strong> {{ $projectRequest->user->name ?? 'Unknown' }}</p>
        <p><strong>Created:</strong> {{ $projectRequest->created_at?->diffForHumans() }}</p>
    </div>

    <div class="card-footer d-flex gap-2">
        <a href="{{ route('project-requests.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <form action="{{ route('project-requests.destroy', $projectRequest->id) }}" method="POST" onsubmit="return confirm('Delete this project request?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
        </form>

        <form action="{{ route('project-requests.like', $projectRequest->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success" 
                {{ $projectRequest->likedBy(Auth::user()) ? 'disabled' : '' }}>
                <i class="fas fa-thumbs-up"></i> {{ $projectRequest->likes()->count() }}
            </button>
        </form>
    </div>
</div>

@stop
