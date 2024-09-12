<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
{
    /**
     * Handle the event.
     */
    public function handle(CommentAdded $event): void
    {
        $comment = $event->comment;

        if ($comment->post) {
            $userTo = $comment->post->author_id;
            $userFrom = $comment->user_id;

            $userFromName = $comment->user->name;

            Notification::create([
                'user_to' => $userTo,
                'user_from' => $userFrom,
                'message' => "User {$userFromName} commented on your post.",
            ]);
        }
    }
}
