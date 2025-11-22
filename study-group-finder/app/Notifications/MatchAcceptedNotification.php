<?php

namespace App\Notifications;

use App\Models\StudyRequestMatch;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MatchAcceptedNotification extends Notification
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
            'message' => 'Your match request has been accepted by '.$this->match->receiver->name,
            'match_id'=> $this->match->id,
        ];
    }
}
