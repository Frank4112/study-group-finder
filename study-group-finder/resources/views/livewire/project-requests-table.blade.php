<div>
    {{-- Search + Filters --}}
    <div class="card mb-3">
        <div class="card-header">
            <form class="row">

                {{-- Search --}}
                <div class="col-md-4">
                    <input
                        type="text"
                        wire:model.live="search"
                        class="form-control"
                        placeholder="Search by title, skills, location..."
                    >
                </div>

                {{-- Status Filter --}}
                <div class="col-md-3 mt-2 mt-md-0">
                    <select wire:model.live="status" class="form-control">
                        <option value="">Filter by Status</option>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>

            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th wire:click="sortBy('title')" class="cursor-pointer">
                            Title
                            @if($sortField === 'title')
                                ({{ strtoupper($sortDirection) }})
                            @endif
                        </th>

                        <th>Description</th>

                        <th wire:click="sortBy('required_skills')" class="cursor-pointer">
                            Required Skills
                            @if($sortField === 'required_skills')
                                ({{ strtoupper($sortDirection) }})
                            @endif
                        </th>

                        <th wire:click="sortBy('max_members')" class="cursor-pointer">
                            Max Members
                            @if($sortField === 'max_members')
                                ({{ strtoupper($sortDirection) }})
                            @endif
                        </th>

                        <th wire:click="sortBy('location')" class="cursor-pointer">
                            Location
                            @if($sortField === 'location')
                                ({{ strtoupper($sortDirection) }})
                            @endif
                        </th>

                        <th wire:click="sortBy('meeting_time')" class="cursor-pointer">
                            Meeting Time
                            @if($sortField === 'meeting_time')
                                ({{ strtoupper($sortDirection) }})
                            @endif
                        </th>

                        <th wire:click="sortBy('status')" class="cursor-pointer">
                            Status
                            @if($sortField === 'status')
                                ({{ strtoupper($sortDirection) }})
                            @endif
                        </th>

                        <th>Owner</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($projectRequests as $pr)
                        <tr>
                            <td>{{ $pr->title }}</td>

                            <td>{{ \Illuminate\Support\Str::limit($pr->description, 60) }}</td>

                            <td>{{ $pr->required_skills ?? '-' }}</td>

                            <td>{{ $pr->max_members ?? '-' }}</td>

                            <td>{{ $pr->location ?? '-' }}</td>

                            <td>
                                @if($pr->meeting_time)
                                    {{ \Carbon\Carbon::parse($pr->meeting_time)->format('H:i') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <span class="badge {{ $pr->status === 'open' ? 'badge-success' : 'badge-secondary' }}">
                                    {{ ucfirst($pr->status) }}
                                </span>
                            </td>

                            <td>{{ $pr->user->name ?? 'Unknown' }}</td>

                            <td class="text-center">
                                {{-- View --}}
                                <a href="{{ route('project-requests.show', $pr->id) }}"
                                   class="btn btn-sm btn-primary" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Like / Accept --}}
<button wire:click="like({{ $pr->id }})"
        class="btn btn-sm {{ $pr->likes()->where('user_id', auth()->id())->exists() ? 'btn-danger' : 'btn-success' }}"
        title="{{ $pr->likes()->where('user_id', auth()->id())->exists() ? 'Unaccept' : 'Accept' }}">
    <i class="fas fa-thumbs-up"></i>
    {{ $pr->likes()->count() }}
</button>


                                {{-- Delete (owner only) --}}
                                @if(auth()->id() === $pr->user_id)
                                    <form action="{{ route('project-requests.destroy', $pr->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this project request?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted p-3">
                                No project requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $projectRequests->links() }}
        </div>
    </div>
</div>
