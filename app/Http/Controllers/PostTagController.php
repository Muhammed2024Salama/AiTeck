<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\Posts\Models\Post;
use App\Http\Controllers\Api\Tags\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    /**
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function attachTag(Request $request, Post $post)
    {
        $tagId = $request->input('tag_id');
        $tag = Tag::findOrFail($tagId);

        $post->tags()->attach($tagId);

        return response()->json([
            'message' => 'Tag attached to post successfully.',
        ], 200);
    }
    /**\
     * @param Post $post
     * @param Tag $tag
     * @return mixed
     */
    public function detachTag(Post $post, Tag $tag)
    {
        $post->tags()->detach($tag->id);

        return response()->json([
            'message' => 'Tag detached from post successfully.',
        ], 200);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function updateTag(Request $request, Post $post)
    {
        $newTagId = $request->input('new_tag_id');
        $oldTagId = $request->input('old_tag_id');

        $newTag = Tag::findOrFail($newTagId);
        $oldTag = Tag::findOrFail($oldTagId);

        $post->tags()->detach($oldTagId);
        $post->tags()->attach($newTagId);

        return response()->json([
            'message' => 'Tag updated successfully.',
        ], 200);
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function showTags(Post $post)
    {
        $tags = $post->tags;

        return response()->json([
            'tags' => $tags,
        ], 200);
    }
}
