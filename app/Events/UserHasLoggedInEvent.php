<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserHasLoggedInEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $user_id;
    public $id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($identifier)
    {
        // var_dump('UserHasLoggedInEvent - construct');
        // $this->user_id = $identifier;
        $this->id = $identifier;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
