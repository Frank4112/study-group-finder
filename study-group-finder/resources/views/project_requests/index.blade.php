@extends('adminlte::page')

@section('title', 'Project Requests')

@section('content_header')
    <h1>Project Requests</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Project Requests</h3>

        <a href="{{ route('project-requests.create') }}"
           class="btn btn-success">
            <i class="fas fa-plus"></i> Add Project Request
        </a>
    </div>

    <div class="card-body">
        <livewire:project-requests-table />
    </div>
</div>

@stop
