<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_name',
        'experience',
        'details',
        'is_urgent',
        'description',
    ];

    protected $casts = [
        'is_urgent' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
