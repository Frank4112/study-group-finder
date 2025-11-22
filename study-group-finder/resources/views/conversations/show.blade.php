@extends('layouts.admin')

@section('title', 'Chat')
@section('page-title', 'Chat')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 flex flex-col h-[70vh]">

    <div class="flex-1 overflow-y-auto mb-4 border p-3 rounded">
        @foreach($messages as $msg)
            <div class="mb-2 {{ $msg->sender_id === auth()->id() ? 'text-right' : '' }}">
                <div class="inline-block px-3 py-2 rounded 
                    {{ $msg->sender_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                    <div class="text-xs text-gray-100">
                        {{ $msg->sender->name }}
                    </div>
                    <div>{{ $msg->body }}</div>
                    <div class="text-[10px] text-gray-100 mt-1">
                        {{ $msg->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('conversations.send', $conversation->id) }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="body" class="flex-1 border px-3 py-2 rounded" placeholder="Type a message..." required>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Send
        </button>
    </form>
</div>
@endsection
