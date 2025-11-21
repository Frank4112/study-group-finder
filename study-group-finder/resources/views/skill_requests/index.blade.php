@extends('layouts.admin')

@section('title', 'Skill Requests')
@section('page-title', 'Skill Requests')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-semibold">All Skill Requests</h2>
        <a href="{{ route('skill_requests.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Request</a>
    </div>

    <table class="w-full table-auto border-collapse border border-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Skill</th>
                <th class="border px-4 py-2">Experience</th>
                <th class="border px-4 py-2">Details</th>
                <th class="border px-4 py-2">Urgency</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skillRequests ?? [] as $request)
            <tr class="hover:bg-gray-100">
                <td class="border px-4 py-2">{{ $request->user->name }}</td>
                <td class="border px-4 py-2">{{ $request->skill_name }}</td>
                <td class="border px-4 py-2">{{ ucfirst($request->experience) }}</td>
                <td class="border px-4 py-2">{{ $request->details }}</td>
                <td class="border px-4 py-2">
                    @if($request->is_urgent)
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Urgent</span>
                    @else
                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Normal</span>
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('skill_requests.edit', $request->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                    <form action="{{ route('skill_requests.destroy', $request->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $skillRequests->links() }}
    </div>
</div>
@endsection
