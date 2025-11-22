<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Study Partner Finder')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <div class="flex h-screen">
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 text-xl font-bold text-blue-600">Study Partner Finder</div>

            <nav class="mt-5">

                <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-200 rounded">
                    Dashboard
                </a>

                <!-- Skills -->
                <a href="{{ route('skills.index') }}" class="block px-4 py-2 hover:bg-gray-200 rounded">
                    Skills
                </a>

                <!-- Study Requests -->
                <a href="{{ route('study-requests.index') }}" class="block px-4 py-2 hover:bg-gray-200 rounded">
                    Study Requests
                </a>

                <!-- Project Requests -->
                <a href="{{ route('project-requests.index') }}" class="block px-4 py-2 hover:bg-gray-200 rounded">
                    Project Requests
                </a>

            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-auto">

            <!-- Topbar -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">@yield('page-title')</h1>

                <div class="flex items-center">

                    <span class="mr-4">
                        Welcome, {{ Auth::user()->name ?? 'Guest' }}
                    </span>

                    <!-- Logout (POST method – Breeze compatible) -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500 hover:underline">
                            Logout
                        </button>
                    </form>

                </div>
            </div>

            <!-- Page Content -->
            <div>
                @yield('content')
            </div>

        </div>
    </div>

</body>
</html>
