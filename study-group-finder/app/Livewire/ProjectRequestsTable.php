<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProjectRequest;

class ProjectRequestsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortField = 'title';
    public $sortDirection = 'asc';

    protected $updatesQueryString = [
        'search',
        'status',
        'sortField',
        'sortDirection',
        'page',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $projects = ProjectRequest::with('user')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('title', 'like', "%{$this->search}%")
                          ->orWhere('description', 'like', "%{$this->search}%")
                          ->orWhere('required_skills', 'like', "%{$this->search}%")
                          ->orWhere('location', 'like', "%{$this->search}%");
                });
            })
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.project-requests-table', [
            'projectRequests' => $projects,
        ]);
    }
}
