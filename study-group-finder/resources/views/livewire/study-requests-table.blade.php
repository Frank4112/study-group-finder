<div>

    {{-- Search + Filters --}}
    <div class="card">
        <div class="card-header">
            <div class="row">

                {{-- SEARCH --}}
                <div class="col-md-4">
                    <input
                        type="text"
                        wire:model.live="search"
                        class="form-control"
                        placeholder="Search by subject, course..."
                    >
                </div>

                {{-- LEVEL FILTER --}}
                <div class="col-md-3">
                    <select wire:model.live="level" class="form-control">
                        <option value="">Filter by Level</option>
                        <option value="first_year">First Year</option>
                        <option value="second_year">Second Year</option>
                        <option value="third_year">Third Year</option>
                        <option value="fourth_year">Fourth Year</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light">
                    <tr>

                        {{-- SUBJECT --}}
                        <th wire:click="sortBy('subject')" style="cursor:pointer;">
                            Subject
                            @if($sortField === 'subject')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>

                        {{-- COURSE --}}
                        <th wire:click="sortBy('course')" style="cursor:pointer;">
                            Course
                            @if($sortField === 'course')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>

                        {{-- LEVEL --}}
                        <th wire:click="sortBy('level')" style="cursor:pointer;">
                            Level
                            @if($sortField === 'level')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                        </th>

                        <th>Description</th>
                        <th>User</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($studyRequests as $req)
                        <tr>

                            <td>{{ $req->subject }}</td>
                            <td>{{ $req->course }}</td>

                            <td>
                                <span class="badge badge-info">
                                    {{ ucfirst(str_replace('_',' ', $req->level)) }}
                                </span>
                            </td>

                            <td>{{ \Illuminate\Support\Str::limit($req->description, 50) }}</td>

                            <td>{{ $req->user->name }}</td>

                            <td class="text-center">

                                {{-- VIEW --}}
                                <a href="{{ route('study-requests.show', $req->id) }}"
                                   class="btn btn-sm btn-primary" title="View">
                                   <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('study-requests.edit', $req->id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                   <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('study-requests.destroy', $req->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this request?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-3 text-muted">
                                No study requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            {{ $studyRequests->links() }}
        </div>
    </div>

</div>
