@extends('layouts.app')

@section('title', $request->title . ' - ConnectU')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('requests.browse') }}" class="text-gray-600 hover:text-gray-900 font-medium inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Browse
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
        
        <!-- Header -->
        <div class="flex items-start justify-between mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center flex-1">
                <div class="w-16 h-16 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-2xl mr-4">
                    {{ substr($request->user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 text-lg">{{ $request->user->name }}</h3>
                    <p class="text-gray-600">{{ $request->user->course }} • Year {{ $request->user->year }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="badge badge-blue text-xs">{{ ucfirst($request->type) }}</span>
                        <span class="text-xs text-gray-500">Posted {{ $request->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            @auth
                @if($request->user_id === auth()->id())
                    <div class="flex gap-2">
                        <a href="{{ route('requests.edit', $request) }}" class="btn-secondary">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('requests.destroy', $request) }}" onsubmit="return confirm('Are you sure you want to delete this request?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $request->title }}</h1>

        <!-- Subject (if applicable) -->
        @if($request->subject)
        <div class="mb-4">
            <span class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-800 rounded-lg font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                {{ $request->subject }}
            </span>
        </div>
        @endif

        <!-- Description -->
        <div class="prose max-w-none mb-6">
            <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $request->description }}</p>
        </div>

        <!-- Skills -->
        @if($request->skills)
        <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Required Skills & Interests</h3>
            <div class="flex flex-wrap gap-2">
                @foreach(explode(',', $request->skills) as $skill)
                    <span class="badge badge-purple">{{ trim($skill) }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Timeline -->
        @if($request->timeline)
        <div class="mb-6 flex items-center text-gray-700">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">Timeline:</span>
            <span class="ml-2">{{ ucwords(str_replace('_', ' ', $request->timeline)) }}</span>
        </div>
        @endif

        <!-- Contact Section -->
        @auth
            @if($request->user_id !== auth()->id())
            <div class="mt-8 p-6 bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl border border-primary-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Interested? Get in Touch!</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    
                    @if($request->contact_email)
                    <a href="mailto:{{ $request->user->email }}" class="flex-1 flex items-center justify-center px-6 py-3 bg-white border-2 border-primary-600 text-primary-600 rounded-lg font-semibold hover:bg-primary-600 hover:text-white transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Send Email
                    </a>
                    @endif

                    @if($request->contact_whatsapp && $request->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $request->whatsapp) }}" target="_blank" class="flex-1 flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp
                    </a>
                    @endif
                </div>
            </div>
            @else
            <div class="mt-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                <p class="text-gray-600 text-center">This is your request. You'll be notified when someone reaches out to you!</p>
            </div>
            @endif
        @else
        <div class="mt-8 p-6 bg-yellow-50 rounded-xl border border-yellow-200">
            <p class="text-center text-gray-700">
                <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Login</a>
                or
                <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700 font-semibold">Sign up</a>
                to contact {{ $request->user->name }}
            </p>
        </div>
        @endauth
    </div>

    <!-- User Profile Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">About {{ $request->user->name }}</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="text-gray-600">{{ $request->user->course }}</span>
            </div>
            
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-gray-600">Year {{ $request->user->year }}</span>
            </div>
        </div>

        @if($request->user->bio)
        <div class="mb-4">
            <p class="text-gray-700 text-sm">{{ $request->user->bio }}</p>
        </div>
        @endif

        @if($request->user->skills)
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-2">Skills</h4>
            <div class="flex flex-wrap gap-2">
                @foreach(explode(',', $request->user->skills) as $skill)
                    <span class="badge badge-blue text-xs">{{ trim($skill) }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection