<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class RoomUpdate implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $data;
    public $roomId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($roomId, $data)
    {
        $this->roomId = $roomId;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['room'];
    }
}
