<?php

namespace App\Notifications;

use App\Models\StudyGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StudyGroupCreated extends Notification
{
    use Queueable;

    public function __construct(
        public StudyGroup $group
    ) {}

    public function via($notifiable)
    {
        return ['database']; // or ['mail', 'database'] if mail configured
    }

    public function toArray($notifiable): array
    {
        return [
            'group_id'   => $this->group->id,
            'group_name' => $this->group->name,
            'message'    => 'You have been added to a new study group.',
        ];
    }
}
