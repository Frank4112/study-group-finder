@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')

<div class="row">
    <!-- Total Users -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalUsers ?? 0 }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Study Requests -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $activeStudyRequests ?? 0 }}</h3>
                <p>Active Study Requests</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
        </div>
    </div>

    <!-- Projects -->
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-purple">
            <div class="inner">
                <h3>{{ $activeProjects ?? 0 }}</h3>
                <p>Active Projects</p>
            </div>
            <div class="icon">
                <i class="fas fa-project-diagram"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Study Requests Table -->
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Recent Study Requests</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Subject</th>
                    <th>Level</th>
                    <th>Urgency</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentRequests ?? [] as $item)
                    <tr>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->level }}</td>
                        <td>
                            @if($item->is_urgent)
                                <span class="badge badge-danger">Urgent</span>
                            @else
                                <span class="badge badge-success">Normal</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if(empty($recentRequests) || count($recentRequests) == 0)
                    <tr>
                        <td colspan="4" class="text-center text-muted p-3">
                            No recent study requests.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@stop
