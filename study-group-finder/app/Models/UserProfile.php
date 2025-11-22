<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferred_location',
        'preferred_time',
        'study_style',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
