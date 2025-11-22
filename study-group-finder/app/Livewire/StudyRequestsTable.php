<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudyRequest;

class StudyRequestsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $level = '';
    public $sortField = 'subject';
    public $sortDirection = 'asc';

    // Levels for dropdown
    public $levels = [
        'first_year' => 'First Year',
        'second_year' => 'Second Year',
        'third_year' => 'Third Year',
        'fourth_year' => 'Fourth Year',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLevel()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc'
                ? 'desc'
                : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        $requests = StudyRequest::with('user')

            // FIXED SEARCH LOGIC: Proper grouping of OR conditions
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('subject', 'like', "%{$this->search}%")
                          ->orWhere('course', 'like', "%{$this->search}%")
                          ->orWhere('level', 'like', "%{$this->search}%")
                          ->orWhere('description', 'like', "%{$this->search}%");
                });
            })

            // LEVEL FILTER
            ->when($this->level, fn($q) =>
                $q->where('level', $this->level)
            )

            // SORTING
            ->orderBy($this->sortField, $this->sortDirection)

            ->paginate(10);

        return view('livewire.study-requests-table', [
            'studyRequests' => $requests,
        ]);
    }
}
