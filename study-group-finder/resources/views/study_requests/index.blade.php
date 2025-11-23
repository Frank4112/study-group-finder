@extends('adminlte::page')

@section('title', 'Study Requests')

@section('content_header')
    <h1>Study Requests</h1>
@stop

@section('content')

{{-- FLASH MESSAGES SHOULD BE OUTSIDE THE CARD --}}
@if(session('success'))
    <div class="alert alert-success fade-message" style="background: transparent; border: none; color: #28a745; font-weight: 600;">
        {{ session('success') }}
    </div>
@endif


@if(session('group_created'))
    <div class="alert alert-info">
        A study group (#{{ session('group_created') }}) was matched for your request.
    </div>
@endif


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

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const msg = document.querySelector('.fade-message');
        if (msg) {
            setTimeout(() => {
                msg.style.transition = "opacity 1s ease";
                msg.style.opacity = 0;
                setTimeout(() => msg.remove(), 1000); // Remove completely after fade
            }, 4000); // visible for 4 seconds
        }
    });
</script>
@stop
