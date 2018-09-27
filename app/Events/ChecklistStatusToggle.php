<?php

namespace App\Events;

use App\Checklist;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChecklistStatusToggle implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $checklist;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Checklist $checklist
     */
    public function __construct(User $user, Checklist $checklist)
    {
        $this->user = $user;
        $this->checklist = $checklist;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('checklist');
    }
}
