@extends('adminlte::page')

@section('title', 'Messages')

@section('content_header')
    <h1>Messages</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Your Study Group Conversations</h3>
        </div>
        <div class="card-body p-0">
            @if($groups->isEmpty())
                <p class="p-3 mb-0 text-muted">
                    You are not a member of any study group yet.
                </p>
            @else
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Group</th>
                            <th>Subject / Course</th>
                            <th>Last Message</th>
                            <th>When</th>
                            <th style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                            @php
                                $lastMessage = $group->messages->first();
                            @endphp
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>
                                    {{ $group->subject }}<br>
                                    <small class="text-muted">{{ $group->course }}</small>
                                </td>
                                <td>
                                    @if($lastMessage)
                                        <strong>{{ $lastMessage->user->name }}:</strong>
                                        {{ \Illuminate\Support\Str::limit($lastMessage->body, 60) }}
                                    @else
                                        <span class="text-muted">No messages yet</span>
                                    @endif
                                </td>
                                <td>
                                    @if($lastMessage)
                                        <small class="text-muted">
                                            {{ $lastMessage->created_at->diffForHumans() }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('study-groups.show', $group->id) }}"
                                       class="btn btn-sm btn-primary">
                                        Open Chat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop
