@extends('adminlte::page')

@section('title', 'Study Request Details')

@section('content_header')
    <h1>Study Request Details</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">
            {{ $studyRequest->subject }}
            ({{ ucfirst(str_replace('_',' ', $studyRequest->level)) }})
        </h3>
    </div>

    <div class="card-body">

        <p><strong>Subject:</strong> {{ $studyRequest->subject }}</p>
        <p><strong>Course:</strong> {{ $studyRequest->course }}</p>
        <p><strong>Level:</strong> {{ ucfirst(str_replace('_', ' ', $studyRequest->level)) }}</p>

        <p><strong>Description:</strong></p>
        <div class="border p-3 rounded bg-light mb-3">
            {{ $studyRequest->description }}
        </div>

        <p><strong>Location:</strong> {{ $studyRequest->location ?? 'Not specified' }}</p>

        <p><strong>Preferred Time:</strong>
            {{ $studyRequest->preferred_time ?? 'Not specified' }}
        </p>

        <p class="mt-3"><strong>Requested By:</strong> {{ $studyRequest->user->name }}</p>
        <p><strong>Created:</strong> {{ $studyRequest->created_at->diffForHumans() }}</p>

    </div>

    <div class="card-footer">

        <a href="{{ route('study-requests.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <a href="{{ route('study-requests.edit', $studyRequest->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>

        <form action="{{ route('study-requests.destroy', $studyRequest->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Delete this study request?')">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>

    </div>
</div>

@stop
