@extends('layouts.admin')

@section('title', $studyGroup->name)
@section('page-title', $studyGroup->name)

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif


    {{-- Group Header --}}
    <h2 class="text-2xl font-semibold mb-4">
        {{ $studyGroup->name }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <div>
            <p><strong>Subject:</strong> {{ $studyGroup->subject }}</p>
            <p><strong>Course:</strong> {{ $studyGroup->course }}</p>
            <p><strong>Level:</strong> 
                {{ ucfirst(str_replace('_', ' ', $studyGroup->level)) }}
            </p>
        </div>

        <div>
            <p><strong>Created By:</strong> {{ $studyGroup->creator->name }}</p>
            <p><strong>Members:</strong> {{ $studyGroup->users->count() }}</p>
            <p><strong>Created At:</strong> {{ $studyGroup->created_at }}</p>
        </div>

    </div>


    {{-- JOIN / LEAVE BUTTON --}}
    <div class="mb-6">
        @if(!$studyGroup->users->contains(auth()->id()))
            <form action="{{ route('study-groups.join', $studyGroup->id) }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Join Group
                </button>
            </form>
        @else
            <form action="{{ route('study-groups.leave', $studyGroup->id) }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Leave Group
                </button>
            </form>
        @endif
    </div>


    {{-- MEMBERS --}}
    <h3 class="text-xl font-semibold mb-2">Group Members</h3>

    <ul class="mb-6 list-disc ml-6">
        @foreach($studyGroup->users as $member)
            <li>{{ $member->name }}</li>
        @endforeach
    </ul>


    {{-- CHAT --}}
    <h3 class="text-xl font-semibold mb-4">Group Chat</h3>

    <div class="border rounded p-4 mb-6 bg-gray-50 max-h-96 overflow-y-auto">

        @forelse($studyGroup->messages as $msg)
            <div class="mb-4">
                <p class="text-sm font-semibold">
                    {{ $msg->user->name }}
                    <span class="text-gray-500 text-xs">
                        {{ $msg->created_at->diffForHumans() }}
                    </span>
                </p>

                <p class="bg-white p-2 rounded border">
                    {{ $msg->body }}
                </p>
            </div>
        @empty
            <p class="text-gray-600">No messages yet.</p>
        @endforelse

    </div>


    {{-- SEND MESSAGE --}}
    @if($studyGroup->users->contains(auth()->id()))
        <form action="{{ route('study-groups.messages.store', $studyGroup->id) }}" method="POST">
            @csrf
            <textarea
                name="body"
                rows="3"
                class="w-full border rounded px-3 py-2 mb-3"
                placeholder="Type your message..."
                required
            ></textarea>

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Send Message
            </button>
        </form>
    @else
        <p class="text-gray-700 mt-4">
            Join the group to participate in the chat.
        </p>
    @endif

</div>
@endsection
