@extends('layouts.app')

@section('title', 'Dashboard - ConnectU')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-primary-600 to-secondary-600 rounded-2xl p-8 text-white mb-8">
        <h1 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-primary-100">Ready to connect with your next study partner?</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Your Requests</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $myRequestsCount ?? 0 }}</p>
                </div>
                <div class="bg-primary-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-secondary-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Matches Found</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $matchesCount ?? 0 }}</p>
                </div>
                <div class="bg-secondary-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Active Requests</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $activeRequestsCount ?? 0 }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Profile Views</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $profileViews ?? 0 }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column - Recent Activity -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Your Recent Requests -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Your Recent Requests</h2>
                    <a href="{{ route('requests.create') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">+ New Request</a>
                </div>

                @if(isset($myRequests) && count($myRequests) > 0)
                    <div class="space-y-4">
                        @foreach($myRequests as $request)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-primary-300 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $request->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($request->description, 100) }}</p>
                                    <div class="flex items-center gap-2">
                                        <span class="badge badge-blue">{{ $request->type }}</span>
                                        <span class="text-xs text-gray-500">{{ $request->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 ml-4">
                                    <a href="{{ route('requests.edit', $request) }}" class="text-gray-400 hover:text-primary-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-500 mb-4">You haven't posted any requests yet</p>
                        <a href="{{ route('requests.create') }}" class="btn-primary inline-block">Post Your First Request</a>
                    </div>
                @endif
            </div>

            <!-- Recommended Matches -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Recommended For You</h2>
                    <a href="{{ route('requests.browse') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">View All</a>
                </div>

                @if(isset($recommendedMatches) && count($recommendedMatches) > 0)
                    <div class="space-y-4">
                        @foreach($recommendedMatches as $match)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-primary-300 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold">
                                            {{ substr($match->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $match->title }}</h3>
                                            <p class="text-xs text-gray-500">by {{ $match->user->name }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($match->description, 80) }}</p>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="badge badge-purple">{{ $match->type }}</span>
                                        <span class="badge badge-green">{{ $match->match_percentage }}% Match</span>
                                    </div>
                                </div>
                                <a href="{{ route('requests.show', $match) }}" class="btn-secondary ml-4 whitespace-nowrap">View</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-gray-500 mb-4">No matches found yet</p>
                        <a href="{{ route('requests.browse') }}" class="btn-primary inline-block">Browse All Requests</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column - Profile Summary & Quick Actions -->
        <div class="space-y-6">
            
            <!-- Profile Summary -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Your Profile</h3>
                
                <div class="text-center mb-4">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-r from-primary-500 to-secondary-500 flex items-center justify-center text-white text-3xl font-bold mx-auto mb-3">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <h4 class="font-semibold text-gray-900">{{ auth()->user()->name }}</h4>
                    <p class="text-sm text-gray-500">{{ auth()->user()->course }} - Year {{ auth()->user()->year }}</p>
                </div>

                <div class="space-y-3 mb-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ auth()->user()->email }}
                    </div>
                </div>

                <a href="{{ route('profile.show') }}" class="btn-primary w-full">Edit Profile</a>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('requests.create') }}" class="flex items-center p-3 bg-primary-50 rounded-lg hover:bg-primary-100 transition group">
                        <div class="bg-primary-500 p-2 rounded-lg group-hover:bg-primary-600 transition">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-gray-900">Post New Request</span>
                    </a>

                    <a href="{{ route('requests.browse') }}" class="flex items-center p-3 bg-secondary-50 rounded-lg hover:bg-secondary-100 transition group">
                        <div class="bg-secondary-500 p-2 rounded-lg group-hover:bg-secondary-600 transition">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-gray-900">Browse Requests</span>
                    </a>

                    <a href="{{ route('profile.show') }}" class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition group">
                        <div class="bg-green-500 p-2 rounded-lg group-hover:bg-green-600 transition">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-gray-900">View Profile</span>
                    </a>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl p-6 border border-yellow-200">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-yellow-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Pro Tip!</h4>
                        <p class="text-sm text-gray-600">Complete your profile and add more skills to get better matches!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection