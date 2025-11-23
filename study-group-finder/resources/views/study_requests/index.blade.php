@extends('adminlte::page')

@section('title', 'Study Requests')

@section('content_header')
    <h1>Study Requests</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Study Requests</h3>

        <a href="{{ route('study-requests.create') }}"
           class="btn btn-success">
            <i class="fas fa-plus"></i> Add Request
        </a>
    </div>

    <div class="card-body">
        <livewire:study-requests-table />
    </div>
</div>

@stop
