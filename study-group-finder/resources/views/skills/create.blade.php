@extends('adminlte::page')

@section('title', 'Add Skill')

@section('content_header')
    <h1>Add Skill</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session('error'))
    <p style="color: #c0392b; font-weight: 500;">
        {{ session('error') }}
    </p>
@endif


        <form action="{{ route('skills.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Skill Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group mt-3">
    <label>Description</label>
    <textarea name="description" rows="3" class="form-control" placeholder="Optional description"></textarea>
   </div>

            <button type="submit" class="btn btn-success mt-3">
                <i class="fas fa-save"></i> Save
            </button>
        </form>
    </div>
</div>

@stop
