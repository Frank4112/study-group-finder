@extends('layouts.admin')

@section('title', 'Study Profile')
@section('page-title', 'Study Profile')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('study-profile.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Learning Style</label>
            <input type="text" name="learning_style" class="w-full border px-3 py-2 rounded"
                   value="{{ old('learning_style', $profile->learning_style ?? '') }}">
        </div>

        <div>
            <label class="block font-medium">Preferred Mode</label>
            <input type="text" name="preferred_mode" class="w-full border px-3 py-2 rounded"
                   value="{{ old('preferred_mode', $profile->preferred_mode ?? '') }}">
        </div>

        <div>
            <label class="block font-medium">Preferred Time Slot</label>
            <input type="text" name="preferred_time_slot" class="w-full border px-3 py-2 rounded"
                   value="{{ old('preferred_time_slot', $profile->preferred_time_slot ?? '') }}">
        </div>

        <div>
            <label class="block font-medium">Strengths</label>
            <textarea name="strengths" class="w-full border px-3 py-2 rounded" rows="3">{{ old('strengths', $profile->strengths ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Weaknesses</label>
            <textarea name="weaknesses" class="w-full border px-3 py-2 rounded" rows="3">{{ old('weaknesses', $profile->weaknesses ?? '') }}</textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save Profile
        </button>
    </form>
</div>
@endsection
