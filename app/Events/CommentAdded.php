<?php

namespace App\Events;

use App\Http\Controllers\Api\Comments\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array|Channel|PrivateChannel|PresenceChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post.' . $this->comment->post_id);
    }

    /**
     * BroadCasts Channels
     */
    public function broadcastWith()
    {
        return [
            'user_from' => $this->comment->user->name,
            'message' => "User {$this->comment->user->name} commented on your post."
        ];
    }
}
