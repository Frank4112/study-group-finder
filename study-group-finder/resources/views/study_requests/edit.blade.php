@extends('adminlte::page')

@section('title', 'Edit Study Request')

@section('content_header')
    <h1>Edit Study Request</h1>
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

        <form action="{{ route('study-requests.update', $studyRequest->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Subject</label>
                <input type="text"
                       name="subject"
                       class="form-control"
                       value="{{ old('subject', $studyRequest->subject) }}"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Course</label>
                <input type="text"
                       name="course"
                       class="form-control"
                       value="{{ old('course', $studyRequest->course) }}"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Level</label>
                <select name="level" class="form-control">
                    <option value="first_year"  {{ old('level', $studyRequest->level) == 'first_year' ? 'selected' : '' }}>First Year</option>
                    <option value="second_year" {{ old('level', $studyRequest->level) == 'second_year' ? 'selected' : '' }}>Second Year</option>
                    <option value="third_year"  {{ old('level', $studyRequest->level) == 'third_year' ? 'selected' : '' }}>Third Year</option>
                    <option value="fourth_year" {{ old('level', $studyRequest->level) == 'fourth_year' ? 'selected' : '' }}>Fourth Year</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label>Location</label>
                <input type="text"
                       name="location"
                       class="form-control"
                       value="{{ old('location', $studyRequest->location) }}">
            </div>

            <div class="form-group mt-3">
                <label>Preferred Time</label>
                <input type="datetime-local"
                       name="preferred_time"
                       class="form-control"
                       value="{{ old('preferred_time', optional($studyRequest->preferred_time)->format('Y-m-d\TH:i')) }}">
            </div>

            <div class="form-group mt-3">
                <label>Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $studyRequest->description) }}</textarea>
            </div>

            <button class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Update
            </button>
        </form>

    </div>
</div>

@stop
