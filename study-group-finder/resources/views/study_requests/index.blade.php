@extends('layouts.admin')

@section('title', 'Study Requests')
@section('page-title', 'Study Requests')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">Study Requests</h2>

        <a href="{{ route('study-requests.create') }}"
           class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Add Request
        </a>
    </div>

    <livewire:study-requests-table />
</div>
@endsection
