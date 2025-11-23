<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'major',
        'year_of_study',
        'points',
        'xp_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Auto-cast attributes.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Award XP / Points to the user.
     * Handles leveling up automatically.
     */
    public function incrementPoints(int $amount): void
    {
        $this->points += $amount;

        // Determine if the user should level up
        while ($this->points >= $this->requiredPointsForNextLevel()) {
            $this->points -= $this->requiredPointsForNextLevel();
            $this->xp_level++;
        }

        $this->save();
    }

    /**
     * XP requirement formula:
     * Level 1 → 50 points
     * Level 2 → 80 points
     * Level 3 → 120 points
     * Level N → increases gradually
     */
    public function requiredPointsForNextLevel(): int
    {
        return 30 + ($this->xp_level * 20);
    }

    /**
     * Just a readable label for the student year.
     */
    public function getYearLabelAttribute(): string
    {
        return match ($this->year_of_study) {
            'first_year'  => 'First Year',
            'second_year' => 'Second Year',
            'third_year'  => 'Third Year',
            'fourth_year' => 'Fourth Year',
            default       => 'Unknown',
        };
    }

    /**
     * Relationship: A user can have multiple study requests
     */
    public function studyRequests()
    {
        return $this->hasMany(StudyRequest::class);
    }

    /**
     * Relationship: A user can belong to multiple study groups.
     */
    public function studyGroups()
    {
        return $this->belongsToMany(
            StudyGroup::class,
            'study_group_members',
            'user_id',
            'study_group_id'
        );
    }

    public function projectRequests()
    {
        return $this->hasMany(\App\Models\ProjectRequest::class);
    }

    public function studyRequests()
    {
        return $this->hasMany(\App\Models\StudyRequest::class);
    }
}
