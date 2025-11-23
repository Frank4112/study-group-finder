@extends('adminlte::page')

@section('title', 'Welcome')

@section('content_header')
    <h1>Welcome to Study Group Finder</h1>
@stop

@section('content')
<div class="row">

    <!-- Hero Section -->
    <div class="col-md-12">
        <div class="card bg-gradient-primary text-white">
            <div class="card-body">
                <h2 class="font-weight-bold">Find Study Partners. Join Groups. Collaborate on Projects.</h2>
                <p class="mt-2">
                    A platform designed to connect Computer Science students with the right study environment.
                </p>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-light mt-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-warning mt-3">Register</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-light mt-3">Go to Dashboard</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <i class="fas fa-users fa-2x text-primary mb-3"></i>
                <h4>Study Requests</h4>
                <p>Post and match with other students who share the same subject and level.</p>
                <a href="{{ route('study-requests.index') }}" class="btn btn-primary">Browse</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <i class="fas fa-project-diagram fa-2x text-success mb-3"></i>
                <h4>Project Requests</h4>
                <p>Find collaborators for course projects, capstones, and research work.</p>
                <a href="{{ route('project-requests.index') }}" class="btn btn-success">Explore</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <i class="fas fa-chalkboard-teacher fa-2x text-warning mb-3"></i>
                <h4>Study Groups</h4>
                <p>Join active groups or create your own study community.</p>
                <a href="{{ route('study-groups.index') }}" class="btn btn-warning">View Groups</a>
            </div>
        </div>
    </div>

</div>
@endsection
