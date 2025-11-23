@extends('adminlte::page')

@section('title', 'Study Groups')

@section('content_header')
    <h1>Study Groups</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Available Study Groups</h3>
    </div>

    <div class="card-body p-0">

        @if($groups->count() === 0)
            <div class="p-4 text-center text-muted">
                No study groups found.
            </div>
        @else
        <table class="table table-hover table-bordered mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Creator</th>
                    <th>Members</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->subject }}</td>
                        <td>{{ $group->course }}</td>
                        <td>{{ ucfirst(str_replace('_',' ', $group->level)) }}</td>

                        <td>{{ $group->creator->name }}</td>

                        <td>
                            <span class="badge badge-primary">
                                {{ $group->members_count }}
                            </span>
                        </td>

                        <td class="text-center">

                            {{-- VIEW --}}
                            <a href="{{ route('study-groups.show', $group->id) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>

                            {{-- JOIN / LEAVE --}}
                            @if(!$group->users->contains(auth()->id()))
                                <form action="{{ route('study-groups.join', $group->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-plus"></i> Join
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('study-groups.leave', $group->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Leave this group?')">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-sign-out-alt"></i> Leave
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>

    <div class="card-footer">
        {{ $groups->links() }}
    </div>

</div>

@stop
