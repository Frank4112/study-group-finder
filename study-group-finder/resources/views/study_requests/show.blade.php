@extends('adminlte::page')

@section('title', 'Study Request Details')

@section('content_header')
    <h1>Study Request Details</h1>
@stop

@section('content')

<div class="card shadow-sm">

    {{-- HEADER --}}
    <div class="card-header">
        <h3 class="card-title">
            {{ $studyRequest->subject }}
            ({{ ucfirst(str_replace('_',' ', $studyRequest->level)) }})
        </h3>
    </div>

    <div class="card-body">

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        {{-- BASIC DETAILS --}}
        <p><strong>Subject:</strong> {{ $studyRequest->subject }}</p>
        <p><strong>Course:</strong> {{ $studyRequest->course }}</p>
        <p><strong>Level:</strong> {{ ucfirst(str_replace('_',' ', $studyRequest->level)) }}</p>

        <p><strong>Description:</strong></p>
        <div class="border p-3 rounded bg-light mb-3">
            {{ $studyRequest->description ?? 'No description provided.' }}
        </div>

        <p><strong>Location:</strong> {{ $studyRequest->location ?? 'Not specified' }}</p>

        <p><strong>Preferred Time:</strong>
            {{ $studyRequest->preferred_time ?? 'Not specified' }}
        </p>

        <p class="mt-3"><strong>Requested By:</strong> {{ $studyRequest->user->name }}</p>
        <p><strong>Created:</strong> {{ $studyRequest->created_at->diffForHumans() }}</p>


        {{-- GROUP INFORMATION --}}
        <hr class="my-4">

        <h4 class="mb-3">Study Group</h4>

        @php
            $group = $studyRequest->group;
        @endphp

        @if(!$group)
            <p class="text-muted">No study group has been created for this request yet.</p>

        @else

            <div class="p-3 border rounded bg-light mb-4">
                <p><strong>Group Name:</strong> {{ $group->name }}</p>
                <p><strong>Members:</strong> {{ $group->users->count() }}</p>

                {{-- Group Actions --}}
                <div class="mt-3">

                    {{-- View Group --}}
                    <a href="{{ route('study-groups.show', $group->id) }}"
                       class="btn btn-info btn-sm mr-1">
                        View Group
                    </a>

                    {{-- Join Group --}}
                    @if(!$group->users->contains(auth()->id()))
                        <form action="{{ route('study-groups.join', $group->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Join Group
                            </button>
                        </form>
                    @else
                        {{-- Leave Group --}}
                        <form action="{{ route('study-groups.leave', $group->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-warning btn-sm">
                                Leave Group
                            </button>
                        </form>
                    @endif

                    {{-- Delete Group (Creator Only) --}}
                    @if($group->creator_id === auth()->id())
                        <form action="{{ route('study-groups.destroy', $group->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this group?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete Group
                            </button>
                        </form>
                    @endif

                </div>
            </div>

        @endif


        {{-- ACTION BAR --}}
        <div class="mt-4">

            {{-- BACK --}}
            <a href="{{ route('study-requests.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            {{-- EDIT / DELETE STUDY REQUEST (OWNER ONLY) --}}
            @if(auth()->id() === $studyRequest->user_id)

                <a href="{{ route('study-requests.edit', $studyRequest->id) }}" class="btn btn-warning ml-1">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <form action="{{ route('study-requests.destroy', $studyRequest->id) }}"
                      method="POST"
                      class="d-inline ml-1"
                      onsubmit="return confirm('Delete this study request?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>

            @endif

            {{-- GROUP ACTIONS AT BOTTOM --}}
            @if($group)

                {{-- VIEW --}}
                <a href="{{ route('study-groups.show', $group->id) }}"
                   class="btn btn-info ml-2">
                    View Group
                </a>

                {{-- JOIN --}}
                @if(!$group->users->contains(auth()->id()))
                    <form action="{{ route('study-groups.join', $group->id) }}"
                          method="POST"
                          class="d-inline ml-1">
                        @csrf
                        <button class="btn btn-success">
                            Join Group
                        </button>
                    </form>

                {{-- LEAVE --}}
                @else
                    <form action="{{ route('study-groups.leave', $group->id) }}"
                          method="POST"
                          class="d-inline ml-1">
                        @csrf
                        <button class="btn btn-warning">
                            Leave Group
                        </button>
                    </form>
                @endif

                {{-- DELETE GROUP (CREATOR ONLY) --}}
                @if($group->creator_id === auth()->id())
                    <form action="{{ route('study-groups.destroy', $group->id) }}"
                          method="POST"
                          class="d-inline ml-1"
                          onsubmit="return confirm('Are you sure you want to delete this group?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            Delete Group
                        </button>
                    </form>
                @endif

            @endif

        </div>

    </div>
</div>

@stop
