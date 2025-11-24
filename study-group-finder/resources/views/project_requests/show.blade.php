@extends('adminlte::page')

@section('title', 'Project Request Details')

@section('content_header')
    <h1>Project Request Details</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">
            {{ $projectRequest->title ?? 'Project Request' }}
        </h3>
    </div>

    <div class="card-body">

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        {{-- PROJECT DETAILS --}}
        <p><strong>Title:</strong> {{ $projectRequest->title }}</p>
        <p><strong>Category:</strong> {{ $projectRequest->category ?? 'Not specified' }}</p>
        <p><strong>Description:</strong></p>

        <div class="border rounded p-3 mb-3 bg-light">
            {{ $projectRequest->description }}
        </div>

        <p><strong>Requested By:</strong> {{ $projectRequest->user->name }}</p>
        <p><strong>Created:</strong> {{ $projectRequest->created_at->diffForHumans() }}</p>

    </div>

    <div class="card-footer">

        {{-- BACK BUTTON --}}
        <a href="{{ route('project-requests.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        {{-- ACTIONS FOR OWNER --}}
        @if(auth()->id() === $projectRequest->user_id)

            <a href="{{ route('project-requests.edit', $projectRequest->id) }}"
               class="btn btn-warning ml-1">
                <i class="fas fa-edit"></i> Edit
            </a>

            <form action="{{ route('project-requests.destroy', $projectRequest->id) }}"
                  method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this request?')">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger ml-1">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>

        @endif


        {{-- JOIN REQUEST BUTTON (not owner) --}}
        @if(auth()->id() !== $projectRequest->user_id)

            @php
                $pendingRequest = $projectRequest->joinRequests
                    ->where('user_id', auth()->id())
                    ->where('status', 'pending')
                    ->first();

                $acceptedRequest = $projectRequest->joinRequests
                    ->where('user_id', auth()->id())
                    ->where('status', 'accepted')
                    ->first();
            @endphp

            {{-- If already accepted --}}
            @if($acceptedRequest)
                <span class="badge badge-success ml-2">
                    You are already a member of this project.
                </span>

            {{-- If already sent --}}
            @elseif($pendingRequest)
                <span class="badge badge-warning ml-2">
                    Join request pending...
                </span>

            {{-- Request to join --}}
            @else
                <form action="{{ route('project.join-request', $projectRequest->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success ml-2">
                        <i class="fas fa-user-plus"></i> Request to Join Project
                    </button>
                </form>
            @endif

        @endif

    </div>
</div>




{{-- JOIN REQUESTS PANEL (OWNER ONLY) --}}
@if(auth()->id() === $projectRequest->user_id)

<div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Join Requests</h3>
    </div>

    <div class="card-body">

        @forelse($projectRequest->joinRequests as $req)

            <div class="border rounded p-3 mb-2">

                <strong>{{ $req->user->name }}</strong>

                <span class="badge 
                    @if($req->status === 'pending') badge-warning
                    @elseif($req->status === 'accepted') badge-success
                    @else badge-danger
                    @endif">
                    {{ ucfirst($req->status) }}
                </span>

                {{-- Pending actions --}}
                @if($req->status === 'pending')

                    <form action="{{ route('project.join-request.accept', $req->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-primary btn-sm ml-2">
                            Accept
                        </button>
                    </form>

                    <form action="{{ route('project.join-request.reject', $req->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm ml-1">
                            Reject
                        </button>
                    </form>

                @endif

            </div>

        @empty

            <p class="text-muted">No join requests yet.</p>

        @endforelse

    </div>
</div>

@endif

@stop
