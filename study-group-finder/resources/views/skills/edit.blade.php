@extends('adminlte::page')

@section('title', 'Edit Skill')

@section('content_header')
    <h1>Edit Skill</h1>
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


        <form action="{{ route('skills.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Skill Name</label>
                <input type="text" name="name" id="name" class="form-control" 
                       value="{{ old('name', $skill->name) }}" required>
            </div>

            <div class="form-group mt-3">
                <label>Description</label>
                <textarea name="description" rows="3" class="form-control">{{ old('description', $skill->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Update
            </button>
        </form>
    </div>
</div>
@stop
