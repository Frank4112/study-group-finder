<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'major', 'year_of_study'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    // User ↔ Skills (Many-to-Many)
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user');
    }

    // User ↔ Projects (Many-to-Many)
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }

    public function projectRequests()
    {
        return $this->hasMany(\App\Models\ProjectRequest::class);
    }

    public function studyRequests()
    {
        return $this->hasMany(\App\Models\StudyRequest::class);
    }
}
