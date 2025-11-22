<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'study_group_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studyGroup()
    {
        return $this->belongsTo(StudyGroup::class);
    }
}
