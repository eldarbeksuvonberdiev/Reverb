<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageCount;
    public $messages;
    /**
     * Create a new event instance.
     */
    public function __construct($messageCount, $messages)
    {
        $this->messageCount = $messageCount;
        $this->messages = $messages;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('notification'),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'message' => [
                'id' => $this->messages->id,
                'name' => $this->messages->name,
                'image' => $this->messages->image,
                'count' => $this->messageCount,
            ],
        ];
    }
}
