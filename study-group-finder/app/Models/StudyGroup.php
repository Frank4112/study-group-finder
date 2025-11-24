<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'course',
        'level',
        'creator_id',
    ];

    /**
     * Creator of the group
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Members of the group
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'study_group_members',
            'study_group_id',
            'user_id'
        )->withTimestamps();
    }

    /**
     * Messages inside group chat
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'study_group_id');
    }

    /**
     * Convenience access: number of members
     */
    public function members()
    {
        return $this->users();
    }
    public function studyRequest()
{
    return $this->belongsTo(\App\Models\StudyRequest::class, 'study_request_id');
}
}