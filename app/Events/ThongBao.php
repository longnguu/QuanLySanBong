<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThongBao implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public $id;
    public $type;
    public function __construct($id,$message,$type)
    {
        //
        $this->id=$id;
        $this->message=$message;
        $this->type=$type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        if ($this->type == 1) {
            return [
                new PrivateChannel('thongbao1.private.'.$this->id),
            ];
        }
        return [
            new PrivateChannel('thongbao2.private.'.$this->id),
        ];
    }
}
