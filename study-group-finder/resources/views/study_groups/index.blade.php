@extends('adminlte::page')

@section('title', 'Study Groups')

@section('content_header')
    <h1>Study Groups</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Available Study Groups</h3>
    </div>

    <div class="card-body">

        @if($groups->isEmpty())
            <p>No study groups available.</p>
        @else

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Subject</th>
                        <th>Course</th>
                        <th>Level</th>
                        <th>Members</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->subject }}</td>
                            <td>{{ $group->course }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $group->level)) }}</td>
                            <td>{{ $group->members_count }}</td>

                            <td>

                                {{-- View button --}}
                                <a href="{{ route('study-groups.show', $group->id) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                {{-- JOIN / LEAVE logic --}}
                                @if(!$group->users->contains(auth()->id()))
                                    <form action="{{ route('study-groups.join', $group->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            Join
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('study-groups.leave', $group->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">
                                            Leave
                                        </button>
                                    </form>
                                @endif

                                {{-- DELETE GROUP (Creator Only) --}}
                                @if($group->creator_id === auth()->id())
                                    <form action="{{ route('study-groups.destroy', $group->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this group?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $groups->links() }}
            </div>

        @endif

    </div>
</div>

@stop
