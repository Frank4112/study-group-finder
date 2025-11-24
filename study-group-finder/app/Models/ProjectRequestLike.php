<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectRequestLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_request_id',
    ];

    public function projectRequest()
    {
        return $this->belongsTo(ProjectRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
