@extends('layouts.sidebar')

@section('page-title', 'Skill Details')

@section('content')

<div class="bg-white p-6 shadow rounded">

    <h2 class="text-2xl font-bold mb-3">
        Skill: {{ $skill->name }}
    </h2>

    <a href="{{ route('skills.index') }}"
       class="text-blue-600 hover:underline mt-4 inline-block">
        Back to Skills
    </a>

</div>

@endsection
