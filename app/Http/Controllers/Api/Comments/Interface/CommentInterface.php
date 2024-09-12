<?php

namespace App\Http\Controllers\Api\Comments\Interface;

use Illuminate\Http\Request;

interface CommentInterface
{
    public function getCommentsByPostId($postId);
    public function createComment(Request $request, $postId);
    public function deleteComment($id);

}
