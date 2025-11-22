<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_title',
        'description',
        'required_skills',
        'difficulty_level'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
