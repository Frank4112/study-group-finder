<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* small extra styling for dashboard */
        .dashboard-container {
            max-width: 900px;
            width: 100%;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
        }

        .card {
            background: #ffffff;
            padding: 18px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .nav-links a {
            margin-left: 10px;
            text-decoration: none;
            color: #1a73e8;
            font-size: 14px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .logout-btn {
            background: #dc2626;
            color: #fff;
            border: none;
            padding: 7px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }
    </style>
</head>
<body>

<div class="auth-container dashboard-container">
    <div class="top-bar">
        <div>
            <h2>Welcome, {{ $user->name }}</h2>
            <p style="margin: 0; color:#555;">
                Major: {{ $user->major }} · Year: {{ $user->year_of_study }}
            </p>
        </div>

        <div class="nav-links">
            {{-- Adjust these routes to match your project --}}
            <a href="{{ url('/project-requests') }}">My Project Requests</a>
            <a href="{{ url('/study-requests') }}">My Study Requests</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>My Project Requests</h3>
            <p>You currently have <strong>{{ $myProjectsCount }}</strong> project request(s).</p>
            <a href="{{ url('/project-requests') }}">View / Manage</a>
        </div>

        <div class="card">
            <h3>My Study Requests</h3>
            <p>You currently have <strong>{{ $myStudiesCount }}</strong> study request(s).</p>
            <a href="{{ url('/study-requests') }}">View / Manage</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

        <!-- Total Users Card -->
        <div class="bg-blue-500 text-white rounded-lg shadow p-5">
            <div class="text-sm font-semibold">Total Users</div>
            <div class="text-2xl font-bold">{{ $totalUsers ?? 0 }}</div>
        </div>

        <!-- Active Study Requests Card -->
        <div class="bg-green-500 text-white rounded-lg shadow p-5">
            <div class="text-sm font-semibold">Active Study Requests</div>
            <div class="text-2xl font-bold">{{ $activeStudyRequests ?? 0 }}</div>
        </div>

        <!-- Active Projects Card -->
        <div class="bg-purple-500 text-white rounded-lg shadow p-5">
            <div class="text-sm font-semibold">Active Projects</div>
            <div class="text-2xl font-bold">{{ $activeProjects ?? 0 }}</div>
        </div>

    </div>

    <!-- Recent Study Requests Table -->
    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Study Requests</h2>
        <table class="min-w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">User</th>
                    <th class="border px-4 py-2 text-left">Subject</th>
                    <th class="border px-4 py-2 text-left">Level</th>
                    <th class="border px-4 py-2 text-left">Urgency</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRequests ?? [] as $request)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $request->user->name }}</td>
                    <td class="border px-4 py-2">{{ $request->subject }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($request->level) }}</td>
                    <td class="border px-4 py-2">
                        @if($request->is_urgent)
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Urgent</span>
                        @else
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Normal</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
