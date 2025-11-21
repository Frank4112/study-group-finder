<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillRequest extends Model
{
    use HasFactory;

    // The table associated with the model (optional if table name follows Laravel convention)
    protected $table = 'skill_requests';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'skill_name',
        'experience', // e.g., beginner, intermediate, advanced
        'details',    // additional description
        'is_urgent',  // boolean for urgency
    ];

    // Casts for certain columns
    protected $casts = [
        'is_urgent' => 'boolean',
    ];

    // Relationships

    /**
     * The user who created this skill request
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
