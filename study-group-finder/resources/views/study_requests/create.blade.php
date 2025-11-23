@extends('adminlte::page')

@section('title', 'Create Study Request')

@section('content_header')
    <h1>Create Study Request</h1>
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

        <form action="{{ route('study-requests.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Subject</label>
                <input type="text"
                       name="subject"
                       class="form-control"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Course</label>
                <input type="text"
                       name="course"
                       class="form-control"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Level</label>
                <select name="level" class="form-control" required>
                    <option value="first_year">First Year</option>
                    <option value="second_year">Second Year</option>
                    <option value="third_year">Third Year</option>
                    <option value="fourth_year">Fourth Year</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label>Location</label>
                <input type="text"
                       name="location"
                       class="form-control">
            </div>

            <div class="form-group mt-3">
                <label>Preferred Time</label>
                <input type="datetime-local"
                       name="preferred_time"
                       class="form-control">
            </div>

            <div class="form-group mt-3">
                <label>Description</label>
                <textarea name="description"
                          rows="4"
                          class="form-control"></textarea>
            </div>

            <button class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Save
            </button>
        </form>

    </div>
</div>

@stop
