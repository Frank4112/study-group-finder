@extends('layouts.sidebar')

@section('page-title', 'Add Skill')

@section('content')

<h2 class="text-xl font-semibold mb-4">Add Skill</h2>

<form method="POST" action="{{ route('skills.store') }}"
      class="bg-white p-6 shadow rounded space-y-4">

    @csrf

    <div>
        <label class="font-semibold">Skill Name</label>
        <input type="text" name="name"
               class="w-full border p-2 rounded"
               placeholder="e.g. Laravel, Networking, Python"
               required>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Save
    </button>

</form>

@endsection
