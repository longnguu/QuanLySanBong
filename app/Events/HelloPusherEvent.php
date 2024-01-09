<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HelloPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $UserId;
    public $UserGui;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$us,$userNhan)
    {
        $this->message = $message;
        $this->UserGui=$us;
        $this->UserId=$userNhan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
//    public function broadcastOn():array
//    {
//        return ['public'];
//    }
    public function broadcastAs():string
    {
        return 'chat';
    }
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('private-chat.'.$this->userId);
    }
}
