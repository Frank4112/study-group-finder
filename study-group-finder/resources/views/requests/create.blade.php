@extends('layouts.app')

@section('title', 'Post a Request - ConnectU')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Post a Request</h1>
        <p class="text-gray-600">Looking for a study or project partner? Let others know!</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
        
        <form method="POST" action="{{ route('requests.store') }}" class="space-y-6">
            @csrf

            <!-- Request Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">What are you looking for?</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-500 transition">
                        <input 
                            type="radio" 
                            name="type" 
                            value="study" 
                            {{ old('type') == 'study' ? 'checked' : 'checked' }}
                            class="sr-only peer"
                            required
                        >
                        <div class="flex items-center w-full">
                            <div class="bg-primary-100 p-3 rounded-lg mr-3 peer-checked:bg-primary-500 peer-checked:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Study Partner</p>
                                <p class="text-sm text-gray-500">For coursework & exams</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 hidden peer-checked:block">
                            <svg class="w-6 h-6 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </label>

                    <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-secondary-500 transition">
                        <input 
                            type="radio" 
                            name="type" 
                            value="project" 
                            {{ old('type') == 'project' ? 'checked' : '' }}
                            class="sr-only peer"
                            required
                        >
                        <div class="flex items-center w-full">
                            <div class="bg-secondary-100 p-3 rounded-lg mr-3 peer-checked:bg-secondary-500 peer-checked:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Project Partner</p>
                                <p class="text-sm text-gray-500">For group projects</p>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 hidden peer-checked:block">
                            <svg class="w-6 h-6 text-secondary-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </label>
                </div>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Request Title
                    <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}"
                    required
                    class="input-field @error('title') border-red-500 @enderror"
                    placeholder="e.g., Looking for ICS 2101 study partner or Need teammate for web dev project"
                >
                <p class="mt-1 text-sm text-gray-500">Be specific and clear about what you're looking for</p>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                    <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    required
                    class="input-field @error('description') border-red-500 @enderror"
                    placeholder="Describe what you're looking for, your goals, timeline, and what skills or qualities you value in a partner..."
                >{{ old('description') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Provide details to help others understand if they're a good fit</p>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Skills/Requirements -->
            <div>
                <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">
                    Required Skills or Interests
                </label>
                <input 
                    type="text" 
                    id="skills" 
                    name="skills" 
                    value="{{ old('skills') }}"
                    class="input-field @error('skills') border-red-500 @enderror"
                    placeholder="e.g., Python, React, Data Analysis, Machine Learning (comma-separated)"
                >
                <p class="mt-1 text-sm text-gray-500">This helps match you with the right partners</p>
                @error('skills')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subject/Unit (for study partners) -->
            <div id="subjectField" class="hidden">
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject/Unit Code
                </label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    value="{{ old('subject') }}"
                    class="input-field @error('subject') border-red-500 @enderror"
                    placeholder="e.g., ICS 2101, MAT 3210"
                >
                @error('subject')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Timeline -->
            <div>
                <label for="timeline" class="block text-sm font-medium text-gray-700 mb-2">
                    Timeline
                </label>
                <select 
                    id="timeline" 
                    name="timeline" 
                    class="input-field @error('timeline') border-red-500 @enderror"
                >
                    <option value="immediate" {{ old('timeline') == 'immediate' ? 'selected' : '' }}>Immediate (Start ASAP)</option>
                    <option value="this_week" {{ old('timeline') == 'this_week' ? 'selected' : '' }}>This Week</option>
                    <option value="this_month" {{ old('timeline') == 'this_month' ? 'selected' : '' }}>This Month</option>
                    <option value="flexible" {{ old('timeline') == 'flexible' ? 'selected' : 'selected' }}>Flexible</option>
                </select>
                @error('timeline')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Preferences -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">How should people contact you?</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="contact_email" 
                            value="1"
                            {{ old('contact_email', true) ? 'checked' : '' }}
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                        >
                        <span class="ml-2 text-gray-700">Email ({{ auth()->user()->email }})</span>
                    </label>
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="contact_whatsapp" 
                            value="1"
                            {{ old('contact_whatsapp') ? 'checked' : '' }}
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                        >
                        <span class="ml-2 text-gray-700">WhatsApp</span>
                    </label>
                </div>
            </div>

            <!-- WhatsApp Number (conditional) -->
            <div id="whatsappField" class="hidden">
                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                    WhatsApp Number
                </label>
                <input 
                    type="tel" 
                    id="whatsapp" 
                    name="whatsapp" 
                    value="{{ old('whatsapp', auth()->user()->phone) }}"
                    class="input-field"
                    placeholder="+254 700 000 000"
                >
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Post Request
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
        <h3 class="font-semibold text-blue-900 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            Tips for a Great Request
        </h3>
        <ul class="space-y-2 text-sm text-blue-900">
            <li class="flex items-start">
                <span class="mr-2">✓</span>
                <span>Be specific about your goals and what you're looking for</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">✓</span>
                <span>Mention your availability and commitment level</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">✓</span>
                <span>List relevant skills or experience you have</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">✓</span>
                <span>Be friendly and approachable in your description</span>
            </li>
        </ul>
    </div>
</div>

<script>
// Show/hide subject field based on type
document.querySelectorAll('input[name="type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const subjectField = document.getElementById('subjectField');
        if (this.value === 'study') {
            subjectField.classList.remove('hidden');
        } else {
            subjectField.classList.add('hidden');
        }
    });
});

// Show/hide WhatsApp field
document.querySelector('input[name="contact_whatsapp"]').addEventListener('change', function() {
    const whatsappField = document.getElementById('whatsappField');
    if (this.checked) {
        whatsappField.classList.remove('hidden');
    } else {
        whatsappField.classList.add('hidden');
    }
});

// Initialize on page load
if (document.querySelector('input[name="type"]:checked')?.value === 'study') {
    document.getElementById('subjectField').classList.remove('hidden');
}
if (document.querySelector('input[name="contact_whatsapp"]')?.checked) {
    document.getElementById('whatsappField').classList.remove('hidden');
}
</script>

@endsection