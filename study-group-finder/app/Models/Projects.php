<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Project ↔ Users (Many-to-Many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    // Project ↔ Skills (Many-to-Many)
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skill');
    }
}

