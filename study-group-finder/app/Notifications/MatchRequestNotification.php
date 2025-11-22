<?php

namespace App\Notifications;

use App\Models\StudyRequestMatch;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MatchRequestNotification extends Notification
{
    use Queueable;

    public function __construct(public StudyRequestMatch $match) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'You have a new match request for subject '.$this->match->studyRequest->subject,
            'from'    => $this->match->requester->name,
            'match_id'=> $this->match->id,
        ];
    }
}
