<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectJoinRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_request_id',
        'user_id',
        'status',
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
