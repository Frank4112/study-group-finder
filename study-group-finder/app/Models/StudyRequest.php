<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'course',
        'level',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
