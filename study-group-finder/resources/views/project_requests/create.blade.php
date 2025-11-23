@extends('adminlte::page')

@section('title', 'Create Project Request')

@section('content_header')
    <h1>Create Project Request</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems:</strong>
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('project-requests.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title') }}"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="form-group mt-3">
                <label>Required Skills</label>
                <input type="text"
                       name="required_skills"
                       class="form-control"
                       value="{{ old('required_skills') }}">
            </div>

            <div class="form-group mt-3">
                <label>Max Members</label>
                <input type="number"
                       name="max_members"
                       class="form-control"
                       value="{{ old('max_members') }}"
                       min="1">
            </div>

            <div class="form-group mt-3">
                <label>Location</label>
                <input type="text"
                       name="location"
                       class="form-control"
                       value="{{ old('location') }}">
            </div>

            <div class="form-group mt-3">
                <label>Meeting Time</label>
                <input type="time"
                       name="meeting_time"
                       class="form-control"
                       value="{{ old('meeting_time') }}">
            </div>

            <div class="form-group mt-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="open"   {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <button class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Save
            </button>
        </form>

    </div>
</div>

@stop
