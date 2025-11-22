<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyRequestMatch extends Model
{
    protected $fillable = [
        'study_request_id',
        'requester_id',
        'receiver_id',
        'score',
        'status',
    ];

    public function studyRequest()
    {
        return $this->belongsTo(StudyRequest::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
