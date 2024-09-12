<?php

namespace App\Http\Controllers\Api\Comments\Repository;

use App\Events\CommentAdded;
use App\Http\Controllers\Api\Comments\Interface\CommentInterface;
use App\Http\Controllers\Api\Comments\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository implements CommentInterface
{

    /**
     * Get comments by post ID
     * @param $postId
     * @return mixed
     */
    public function getCommentsByPostId($postId)
    {
        return Comment::where('post_id', $postId)->get();
    }

    /**
     * Create a new comment
     * @param Request $request
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function createComment(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        $comment = Comment::create([
            'content' => $request->input(['content']),
            'post_id' => $postId,
            'user_id' => auth()->user()->id,
        ]);

        $comment->load('post');

        CommentAdded::dispatch($comment);

        return response()->json($comment, 201);
    }

    /**
     * Delete a comment by ID
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id && !auth()->user()->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
