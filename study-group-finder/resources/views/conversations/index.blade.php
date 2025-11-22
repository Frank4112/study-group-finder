@extends('layouts.admin')

@section('title', 'Conversations')
@section('page-title', 'Conversations')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Your Conversations</h2>

    @forelse($conversations as $conversation)
        @php
            $other = $conversation->user_one_id === auth()->id() 
                ? $conversation->userTwo 
                : $conversation->userOne;
        @endphp

        <div class="border-b py-3 flex justify-between">
            <div>
                <div class="font-semibold">{{ $other->name }}</div>
                <div class="text-sm text-gray-500">{{ $other->email }}</div>
            </div>
            <a href="{{ route('conversations.show', $conversation->id) }}"
               class="text-blue-600 hover:underline">
                Open Chat
            </a>
        </div>
    @empty
        <p class="text-gray-600">No conversations yet.</p>
    @endforelse
</div>
@endsection
