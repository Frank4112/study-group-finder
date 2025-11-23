<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectRequestsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'title';
    public $sortDirection = 'asc';

    protected $updatesQueryString = [
        'search', 'status', 'sortField', 'sortDirection', 'page',
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatus() { $this->resetPage(); }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // Like / Unike function
    public function like($projectId)
    {
        $project = ProjectRequest::findOrFail($projectId);
        $user = Auth::user();

        if ($project->likes()->where('user_id', $user->id)->exists()) {
            // Unlike
            $project->likes()->detach($user->id);
            $user->decrement('points', 5);
            session()->flash('success', 'You unaccepted this project. Points removed.');
        } else {
            // Like
            $project->likes()->attach($user->id);
            $user->increment('points', 5);
            session()->flash('success', 'You accepted this project. Points added!');
        }
    }

    public function render()
    {
        $projects = ProjectRequest::with('user')
            ->when($this->search, function($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('required_skills', 'like', "%{$this->search}%")
                  ->orWhere('location', 'like', "%{$this->search}%");
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.project-requests-table', [
            'projectRequests' => $projects,
        ]);
    }
}
