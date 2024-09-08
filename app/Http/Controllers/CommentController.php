<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index($postId)
    {
        return Comment::where('post_id', $postId)->get();
    }

    public function store(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $postId,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($comment, 201);
    }

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
