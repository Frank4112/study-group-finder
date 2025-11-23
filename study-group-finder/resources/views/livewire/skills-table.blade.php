<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Available Skills</h3>
        <a href="{{ route('skills.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Skill
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <p id="success-message" class="text-success font-weight-bold mb-3">
                {{ session('success') }}
            </p>
        @endif

        <div class="input-group mb-3">
            <input type="text"
                   wire:model.debounce.500ms="search"
                   class="form-control"
                   placeholder="Search skills..."
                   id="search-input">

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="applySearch()">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th wire:click="sortBy('id')" style="cursor:pointer;">
                        #
                        @if($sortField === 'id')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('name')" style="cursor:pointer;">
                        Name
                        @if($sortField === 'name')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('description')" style="cursor:pointer;">
                        Description
                        @if($sortField === 'description')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @php $counter = ($skills->currentPage() - 1) * $skills->perPage() + 1; @endphp
                @forelse($skills as $skill)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $skill->name }}</td>
                        <td>{{ $skill->description }}</td>
                        <td>
                            <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">No skills found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $skills->links() }}
        </div>
    </div>
</div>

@section('js')
<script>
    function applySearch() {
        const input = document.getElementById('search-input');
        window.Livewire.emit('searchUpdated', input.value);
    }

    // Fade out success
    window.addEventListener('DOMContentLoaded', () => {
        const msg = document.getElementById('success-message');
        if (msg) setTimeout(() => { msg.style.transition = 'opacity 0.5s'; msg.style.opacity = '0'; }, 3000);
    });
</script>
@stop
