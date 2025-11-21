<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'title',
        'description',
        'status', // e.g., open, closed, in-progress
    ];

    /**
     * Projects ↔ Users (Many-to-Many)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    /**
     * Projects ↔ Skills (Many-to-Many)
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skill');
    }

    /**
     * Projects ↔ Project Requests (One-to-Many)
     */
    public function requests()
    {
        return $this->hasMany(ProjectRequest::class);
    }
}
