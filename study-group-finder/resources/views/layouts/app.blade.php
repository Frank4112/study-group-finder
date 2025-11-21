<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ConnectU - Find Your Study Partner')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    
    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-lg p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">ConnectU</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Dashboard</a>
                        <a href="{{ route('requests.browse') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Browse Requests</a>
                        <a href="{{ route('requests.create') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Post Request</a>
                        <a href="{{ route('profile.show') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">My Profile</a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 font-medium transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Home</a>
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-primary-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">Dashboard</a>
                    <a href="{{ route('requests.browse') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">Browse Requests</a>
                    <a href="{{ route('requests.create') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">Post Request</a>
                    <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">My Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-gray-700 hover:bg-red-50 hover:text-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">Home</a>
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">Login</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-primary-50 hover:text-primary-600">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-lg p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">ConnectU</span>
                    </div>
                    <p class="text-gray-400 mb-4">Find your perfect study and project partner. Connect with like-minded students and achieve more together.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('requests.browse') }}" class="text-gray-400 hover:text-white transition">Browse Requests</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition">Get Started</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} ConnectU. Built with ❤️ for students, by students.</p>
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>