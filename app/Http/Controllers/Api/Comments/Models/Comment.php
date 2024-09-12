<?php

namespace App\Http\Controllers\Api\Comments\Models;

use App\Http\Controllers\Api\Posts\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'content'
    ];

    /**
     * Get the post that the comment belongs to.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user who made the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
