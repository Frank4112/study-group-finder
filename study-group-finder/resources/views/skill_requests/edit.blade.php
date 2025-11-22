@extends('layouts.sidebar')

@section('page-title', 'Edit Skill')

@section('content')

<h2 class="text-xl font-semibold mb-4">Edit Skill</h2>

<form method="POST"
      action="{{ route('skills.update', $skill->id) }}"
      class="bg-white p-6 shadow rounded space-y-4">

    @csrf
    @method('PUT')

    <div>
        <label class="font-semibold">Skill Name</label>
        <input type="text" name="name"
               class="w-full border p-2 rounded"
               value="{{ $skill->name }}"
               required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Update
    </button>

</form>

@endsection
