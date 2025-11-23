<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Study Partner Finder')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .sidebar-collapsed {
            width: 4rem !important;
        }

        .sidebar-collapsed .sidebar-text {
            display: none !important;
        }

        .sidebar-collapsed .sidebar-icon {
            margin-left: 0.6rem !important;
        }
    </style>

    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("sidebar-collapsed");
        }
    </script>
</head>

<body class="bg-gray-100 font-sans h-screen overflow-hidden">

<div class="flex h-full">

    <!-- Sidebar -->
    <aside id="sidebar"
           class="w-64 bg-white shadow-md transition-all duration-300">

        <!-- Logo + Collapse Button -->
        <div class="flex items-center justify-between p-4 border-b">
            <span class="text-xl font-bold text-blue-600 sidebar-text">
                Study Partner Finder
            </span>

            <button onclick="toggleSidebar()"
                    class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- NAVIGATION -->
        <nav class="mt-4">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded
               {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 sidebar-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                </svg>
                <span class="ml-3 sidebar-text">Dashboard</span>
            </a>

            <!-- SKILLS -->
            <a href="{{ route('skills.index') }}"
               class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded
               {{ request()->routeIs('skills.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 sidebar-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 6v6l4 2"/>
                </svg>
                <span class="ml-3 sidebar-text">Skills</span>
            </a>

            <!-- STUDY REQUESTS -->
            <a href="{{ route('study-requests.index') }}"
               class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded
               {{ request()->routeIs('study-requests.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 sidebar-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10m-10 4h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="ml-3 sidebar-text">Study Requests</span>
            </a>

            <!-- PROJECT REQUESTS -->
            <a href="{{ route('project-requests.index') }}"
               class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded
               {{ request()->routeIs('project-requests.*') ? 'bg-gray-200 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 sidebar-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m-3-14l9 9-9 9-9-9 9-9z"/>
                </svg>
                <span class="ml-3 sidebar-text">Project Requests</span>
            </a>

            <!-- MY GROUPS -->
            <a href="{{ route('study-groups.my') }}"
               class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded
               {{ request()->routeIs('study-groups.my') ? 'bg-blue-100 text-blue-700 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 sidebar-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 20h5V4H2v16h5m10 0v-6h-6v6m6 0h-6"/>
                </svg>
                <span class="ml-3 sidebar-text">My Study Groups</span>
            </a>

            <!-- ALL GROUPS -->
            <a href="{{ route('study-groups.index') }}"
               class="flex items-center px-4 py-2 hover:bg-gray-200 transition rounded
               {{ request()->routeIs('study-groups.index') ? 'bg-blue-100 text-blue-700 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 sidebar-icon"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 20h5V4H2v16h5m10 0v-6h-6v6m6 0h-6"/>
                </svg>
                <span class="ml-3 sidebar-text">All Study Groups</span>
            </a>

        </nav>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 overflow-auto h-full">

        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">@yield('page-title')</h1>

            <div class="flex items-center">

                <span class="mr-4">
                    Welcome, {{ Auth::user()->name ?? 'Guest' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:underline">Logout</button>
                </form>

            </div>
        </div>

        <!-- Content -->
        @yield('content')

    </main>

</div>

</body>
</html>
