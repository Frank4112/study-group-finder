@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'All Users')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">Users</h2>
        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add User</a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Major</th>
                <th class="border px-4 py-2">Year</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users ?? [] as $user)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ $user->major }}</td>
                <td class="border px-4 py-2">{{ $user->year_of_study }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
