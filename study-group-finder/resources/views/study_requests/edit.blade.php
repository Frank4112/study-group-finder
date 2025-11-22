@extends('layouts.admin')

@section('title', 'Edit Study Request')
@section('page-title', 'Edit Study Request')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <strong>There were some problems:</strong>
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('study-requests.update', $studyRequest->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Subject -->
        <div class="mb-4">
            <label class="block font-medium">Subject</label>
            <input type="text" name="subject"
                   value="{{ old('subject', $studyRequest->subject) }}"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Course -->
        <div class="mb-4">
            <label class="block font-medium">Course</label>
            <input type="text" name="course"
                   value="{{ old('course', $studyRequest->course) }}"
                   class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Level -->
        <div class="mb-4">
            <label class="block font-medium">Level</label>
            <select name="level" class="w-full border px-3 py-2 rounded" required>
                <option value="first_year"
                    {{ old('level', $studyRequest->level)=='first_year'?'selected':'' }}>
                    First Year
                </option>

                <option value="second_year"
                    {{ old('level', $studyRequest->level)=='second_year'?'selected':'' }}>
                    Second Year
                </option>

                <option value="third_year"
                    {{ old('level', $studyRequest->level)=='third_year'?'selected':'' }}>
                    Third Year
                </option>

                <option value="fourth_year"
                    {{ old('level', $studyRequest->level)=='fourth_year'?'selected':'' }}>
                    Fourth Year
                </option>
            </select>
        </div>

        <!-- Location -->
        <div class="mb-4">
            <label class="block font-medium">Location</label>
            <input type="text" name="location"
                   value="{{ old('location', $studyRequest->location) }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Preferred Time -->
        <div class="mb-4">
            <label class="block font-medium">Preferred Time</label>
            <input type="datetime-local" name="preferred_time"
                   value="{{ old('preferred_time', $studyRequest->preferred_time ? $studyRequest->preferred_time->format('Y-m-d\TH:i') : '') }}"
                   class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label class="block font-medium">Description</label>
            <textarea name="description"
                      class="w-full border px-3 py-2 rounded"
                      rows="4">{{ old('description', $studyRequest->description) }}</textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Request
        </button>
    </form>

</div>
@endsection
