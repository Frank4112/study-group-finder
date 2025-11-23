@extends('layouts.admin')

@section('title', 'My Study Groups')
@section('page-title', 'My Study Groups')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    <h2 class="text-2xl font-semibold mb-6">Groups You Are In</h2>

    @if($groups->isEmpty())
        <p class="text-gray-600">You are not in any groups yet.</p>
    @else
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 border">Group Name</th>
                    <th class="px-4 py-2 border">Subject</th>
                    <th class="px-4 py-2 border">Course</th>
                    <th class="px-4 py-2 border">Level</th>
                    <th class="px-4 py-2 border">Members</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($groups as $group)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $group->name }}</td>
                    <td class="border px-4 py-2">{{ $group->subject }}</td>
                    <td class="border px-4 py-2">{{ $group->course }}</td>
                    <td class="border px-4 py-2">{{ ucfirst(str_replace('_',' ',$group->level)) }}</td>
                    <td class="border px-4 py-2">{{ $group->members_count }}</td>

                    <td class="border px-4 py-2">
                        <a href="{{ route('study-groups.show', $group->id) }}"
                           class="text-blue-600 hover:underline">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
