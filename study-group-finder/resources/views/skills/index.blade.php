@extends('adminlte::page')

@section('title', 'Skills')

@section('content_header')
    <h1>Skills</h1>
@stop

@section('content')
    {{-- Livewire component for skills table --}}
    @livewire('skills-table')
@stop
