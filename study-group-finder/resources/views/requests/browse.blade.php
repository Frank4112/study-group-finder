@extends('layouts.app')

@section('title', 'Browse Requests - ConnectU')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Browse Requests</h1>
        <p class="text-gray-600">Find your perfect study or project partner</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('requests.browse') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input 
                    type="text" 
                    id="search" 
                    name="search" 
                    value="{{ request('search') }}"
                    class="input-field"
                    placeholder="Search by title, description, or skills..."
                >
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select id="type" name="type" class="input-field">
                    <option value="">All Types</option>
                    <option value="study" {{ request('type') == 'study' ? 'selected' : '' }}>Study Partner</option>
                    <option value="project" {{ request('type') == 'project' ? 'selected' : '' }}>Project Partner</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                <select id="sort" name="sort" class="input-field">
                    <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent</option>
                    <option value="relevant" {{ request('sort') == 'relevant' ? 'selected' : '' }}>Most Relevant</option>
                </select>
            </div>

            <!-- Search Button -->
            <div class="md:col-span-4 flex gap-4">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Search
                </button>
                <a href="{{ route('requests.browse') }}" class="btn-secondary">
                    Clear Filters
                </a>
            </div>
        </form>
    </div>

    <!-- Results Count -->
    <div class="mb-6">
        <p class="text-gray-600">
            <span class="font-semibold text-gray-900">{{ $requests->total() ?? 0 }}</span> requests found
        </p>
    </div>

    <!-- Requests Grid -->
    @if(isset($requests) && count($requests) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            @foreach($requests as $request)
            <div class="card hover:scale-105 transform transition duration-300">
                
                <!-- Header -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                            {{ substr($request->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $request->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $request->user->course }} • Year {{ $request->user->year }}</p>
                        </div>
                    </div>
                    <span class="badge badge-blue">{{ ucfirst($request->type) }}</span>
                </div>

                <!-- Title & Description -->
                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $request->title }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($request->description, 150) }}</p>

                <!-- Skills/Tags -->
                @if($request->skills)
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach(explode(',', $request->skills) as $skill)
                        <span class="badge badge-purple text-xs">{{ trim($skill) }}</span>
                    @endforeach
                </div>
                @endif

                <!-- Footer -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $request->created_at->diffForHumans() }}
                    </div>
                    <a href="{{ route('requests.show', $request) }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                        View Details →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $requests->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No requests found</h3>
            <p class="text-gray-600 mb-6">Try adjusting your filters or be the first to post!</p>
            <a href="{{ route('requests.create') }}" class="btn-primary inline-block">
                Post a Request
            </a>
        </div>
    @endif
</div>

@endsection