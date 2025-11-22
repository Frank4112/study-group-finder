@extends('layouts.admin')

@section('title', $studyGroup->name)
@section('page-title', $studyGroup->name)

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 space-y-4">

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <h2 class="text-xl font-semibold">{{ $studyGroup->name }}</h2>
        <p class="text-gray-600">
            Subject: {{ $studyGroup->subject }} |
            Course: {{ $studyGroup->course }} |
            Level: {{ ucfirst(str_replace('_', ' ', $studyGroup->level)) }}
        </p>
        <p class="text-gray-600">
            Created by: {{ $studyGroup->creator->name }}
        </p>
    </div>

    <div>
        <h3 class="font-semibold mb-2">Members</h3>
        <ul class="list-disc ml-6">
            @foreach($studyGroup->users as $user)
                <li>{{ $user->name }} ({{ $user->email }})</li>
            @endforeach
        </ul>
    </div>

    <div class="flex gap-3">
        <form action="{{ route('study-groups.join', $studyGroup->id) }}" method="POST">
            @csrf
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Join Group
            </button>
        </form>

        <form action="{{ route('study-groups.leave', $studyGroup->id) }}" method="POST">
            @csrf
            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Leave Group
            </button>
        </form>
    </div>

    <hr>

    <div>
        <h3 class="font-semibold mb-2">Group Chat</h3>

        <div class="max-h-64 overflow-y-auto border rounded p-3 mb-3 bg-gray-50">
            @forelse($studyGroup->messages as $message)
                <div class="mb-2">
                    <span class="font-semibold">{{ $message->user->name }}</span>
                    <span class="text-xs text-gray-500">
                        ({{ $message->created_at->format('Y-m-d H:i') }})
                    </span>
                    <p>{{ $message->body }}</p>
                </div>
            @empty
                <p class="text-gray-500">No messages yet.</p>
            @endforelse
        </div>

        <form action="{{ route('study-groups.messages.store', $studyGroup->id) }}" method="POST">
            @csrf
            <textarea name="body" class="w-full border rounded px-3 py-2 mb-2"
                      rows="3" placeholder="Type your message..." required></textarea>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Send Message
            </button>
        </form>
    </div>

    <a href="{{ route('study-groups.index') }}" class="text-blue-600 underline">
        ← Back to Study Groups
    </a>
</div>
@endsection
