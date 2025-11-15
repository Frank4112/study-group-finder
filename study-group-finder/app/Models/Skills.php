<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Skill ↔ Users (Many-to-Many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'skill_user');
    }

    // Skill ↔ Projects (Many-to-Many)
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_skill');
    }
}

