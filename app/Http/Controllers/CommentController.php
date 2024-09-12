<?php

namespace App\Http\Controllers;

use App\Events\CommentAdded;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param $postId
     * @return mixed
     */
    public function index($postId)
    {
        return Comment::where('post_id', $postId)->get();
    }

    /**
     * @param Request $request
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $postId)
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id && !auth()->user()->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
