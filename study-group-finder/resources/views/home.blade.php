@extends('layouts.app')

@section('title', 'ConnectU - Find Your Perfect Study Partner')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary-600 via-primary-700 to-secondary-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Hero Text -->
            <div>
                <h1 class="text-5xl font-bold mb-6 leading-tight">Find Your Perfect Study & Project Partner</h1>
                <p class="text-xl text-primary-100 mb-8">Connect with like-minded students. Collaborate on projects. Excel together. Stop searching in noisy WhatsApp groups.</p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="bg-white text-primary-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-primary-50 transition duration-300 text-center shadow-xl">
                        Get Started Free
                    </a>
                    <a href="{{ route('requests.browse') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-primary-600 transition duration-300 text-center">
                        Browse Requests
                    </a>
                </div>
            </div>

            <!-- Hero Illustration -->
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <svg class="w-full h-64" viewBox="0 0 400 300" fill="none">
                        <circle cx="200" cy="150" r="80" fill="#ffffff" opacity="0.2"/>
                        <circle cx="150" cy="120" r="40" fill="#ffffff" opacity="0.9"/>
                        <circle cx="250" cy="120" r="40" fill="#ffffff" opacity="0.9"/>
                        <circle cx="200" cy="180" r="40" fill="#ffffff" opacity="0.9"/>
                        <line x1="150" y1="120" x2="200" y2="180" stroke="#ffffff" stroke-width="3" opacity="0.6"/>
                        <line x1="250" y1="120" x2="200" y2="180" stroke="#ffffff" stroke-width="3" opacity="0.6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Problem Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">The Problem We're Solving</h2>
            <p class="text-xl text-gray-600">Finding the right study or project partner shouldn't be this hard</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Academic Isolation</h3>
                <p class="text-gray-600">Students feel alone in their studies with no easy way to connect</p>
            </div>

            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Noisy WhatsApp Groups</h3>
                <p class="text-gray-600">Unstructured, random matching with too much noise</p>
            </div>

            <div class="text-center p-6">
                <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Missed Opportunities</h3>
                <p class="text-gray-600">Poor collaboration leads to missed project opportunities</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">How ConnectU Works</h2>
            <p class="text-xl text-gray-600">Simple, effective, and built for students</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Feature 1 -->
            <div class="card">
                <div class="bg-primary-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Create Your Profile</h3>
                <p class="text-gray-600">Add your skills, course, year of study, and interests</p>
            </div>

            <!-- Feature 2 -->
            <div class="card">
                <div class="bg-secondary-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Post or Browse Requests</h3>
                <p class="text-gray-600">Need a study buddy for ICS 2101? Post it or browse existing requests</p>
            </div>

            <!-- Feature 3 -->
            <div class="card">
                <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Smart Matching</h3>
                <p class="text-gray-600">Get matched based on subjects, skills, and interests</p>
            </div>

            <!-- Feature 4 -->
            <div class="card">
                <div class="bg-yellow-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Connect Instantly</h3>
                <p class="text-gray-600">Reach out via WhatsApp or email directly</p>
            </div>

            <!-- Feature 5 -->
            <div class="card">
                <div class="bg-pink-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Build Your Network</h3>
                <p class="text-gray-600">Create lasting study groups and project teams</p>
            </div>

            <!-- Feature 6 -->
            <div class="card">
                <div class="bg-indigo-100 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Excel Together</h3>
                <p class="text-gray-600">Achieve more with the right partners by your side</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-600 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Find Your Study Partner?</h2>
        <p class="text-xl text-primary-100 mb-8">Join hundreds of students already collaborating on ConnectU</p>
        <a href="{{ route('register') }}" class="bg-white text-primary-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-primary-50 transition duration-300 inline-block shadow-xl">
            Get Started Now - It's Free
        </a>
    </div>
</section>

@endsection