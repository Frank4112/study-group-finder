@extends('layouts.app')

@section('title', 'Register - ConnectU')

@section('content')

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-primary-50 to-secondary-50">
    <div class="max-w-2xl w-full">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Join ConnectU Today</h2>
            <p class="text-gray-600">Start finding your perfect study and project partners</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            required 
                            autofocus
                            class="input-field @error('name') border-red-500 @enderror"
                            placeholder="John Doe"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="input-field @error('email') border-red-500 @enderror"
                            placeholder="you@university.edu"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course -->
                    <div>
                        <label for="course" class="block text-sm font-medium text-gray-700 mb-2">Course</label>
                        <input 
                            type="text" 
                            id="course" 
                            name="course" 
                            value="{{ old('course') }}"
                            required
                            class="input-field @error('course') border-red-500 @enderror"
                            placeholder="Computer Science"
                        >
                        @error('course')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Year of Study -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year of Study</label>
                        <select 
                            id="year" 
                            name="year" 
                            required
                            class="input-field @error('year') border-red-500 @enderror"
                        >
                            <option value="">Select year</option>
                            <option value="1" {{ old('year') == '1' ? 'selected' : '' }}>Year 1</option>
                            <option value="2" {{ old('year') == '2' ? 'selected' : '' }}>Year 2</option>
                            <option value="3" {{ old('year') == '3' ? 'selected' : '' }}>Year 3</option>
                            <option value="4" {{ old('year') == '4' ? 'selected' : '' }}>Year 4</option>
                            <option value="5" {{ old('year') == '5' ? 'selected' : '' }}>Year 5+</option>
                        </select>
                        @error('year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="input-field @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            class="input-field"
                            placeholder="••••••••"
                        >
                    </div>
                </div>

                <!-- Skills/Interests -->
                <div>
                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills & Interests (comma-separated)</label>
                    <input 
                        type="text" 
                        id="skills" 
                        name="skills" 
                        value="{{ old('skills') }}"
                        class="input-field @error('skills') border-red-500 @enderror"
                        placeholder="Web Development, Data Science, Mobile Apps"
                    >
                    <p class="mt-1 text-sm text-gray-500">This helps us match you with the right partners</p>
                    @error('skills')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio (Optional)</label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        rows="3"
                        class="input-field @error('bio') border-red-500 @enderror"
                        placeholder="Tell others about yourself..."
                    >{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        name="terms"
                        required
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1"
                    >
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the 
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Terms of Service</a>
                        and 
                        <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full btn-primary">
                    Create Account
                </button>
            </form>

            <!-- Divider -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Already have an account?</span>
                    </div>
                </div>
            </div>

            <!-- Login Link -->
            <div class="mt-6">
                <a href="{{ route('login') }}" class="w-full btn-secondary block text-center">
                    Login Instead
                </a>
            </div>
        </div>
    </div>
</div>

@endsection