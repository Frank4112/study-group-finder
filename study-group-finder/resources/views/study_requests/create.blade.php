@extends('adminlte::page')

@section('title', 'Create Study Request')

@section('content_header')
    <h1>Create Study Request</h1>
@stop

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems:</strong>
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('study-requests.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Subject</label>
                <input type="text"
                       name="subject"
                       class="form-control"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Course</label>
                <input type="text"
                       name="course"
                       class="form-control"
                       required>
            </div>

            <div class="form-group mt-3">
                <label>Level</label>
                <select name="level" class="form-control" required>
                    <option value="first_year">First Year</option>
                    <option value="second_year">Second Year</option>
                    <option value="third_year">Third Year</option>
                    <option value="fourth_year">Fourth Year</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label>Location</label>
                <input type="text"
                       name="location"
                       class="form-control">
            </div>

            <div class="form-group mt-3">
                <label>Preferred Time</label>
                <input type="datetime-local"
                       name="preferred_time"
                       class="form-control">
            </div>

            <div class="form-group mt-3">
                <label>Description</label>
                <textarea name="description"
                          rows="4"
                          class="form-control"></textarea>
            </div>

            {{-- Skills + Experience --}}
<div class="form-group mt-3">
    <label>Select Skills and Experience</label>

    <div id="skills-container">
        <div class="skill-row mb-2 d-flex align-items-center">
            <select name="skills[]" class="form-control w-50 mr-2" required>
                <option value="">-- Select Skill --</option>
                @foreach($skills as $skill)
                    <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                @endforeach
            </select>

            <select name="experience[]" class="form-control w-25" required>
                <option value="first_year">First Year</option>
                <option value="second_year">Second Year</option>
                <option value="third_year">Third Year</option>
                <option value="fourth_year">Fourth Year</option>
            </select>

            <button type="button" class="btn btn-danger btn-sm ml-2 remove-skill">Remove</button>
        </div>
    </div>

    <button type="button" id="add-skill" class="btn btn-secondary btn-sm mt-2">
        Add Another Skill
    </button>
</div>


            <button class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Save
            </button>
        </form>

    </div>
</div>

@stop
@section('js')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const skillsContainer = document.getElementById('skills-container');
    const addSkillBtn = document.getElementById('add-skill');

    addSkillBtn.addEventListener('click', () => {
        const skillRow = skillsContainer.querySelector('.skill-row').cloneNode(true);
        skillRow.querySelector('select[name="skills[]"]').value = '';
        skillRow.querySelector('select[name="experience[]"]').value = 'first_year';
        skillsContainer.appendChild(skillRow);
    });

    skillsContainer.addEventListener('click', (e) => {
        if(e.target.classList.contains('remove-skill')) {
            const row = e.target.closest('.skill-row');
            if(skillsContainer.querySelectorAll('.skill-row').length > 1) {
                row.remove();
            }
        }
    });
});
</script>
@stop
