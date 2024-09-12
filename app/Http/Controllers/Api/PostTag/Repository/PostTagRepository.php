<?php

namespace App\Http\Controllers\Api\PostTag\Repository;

use App\Http\Controllers\Api\Posts\Models\Post;
use App\Http\Controllers\Api\PostTag\Interface\PostTagInterface;
use App\Http\Controllers\Api\Tags\Models\Tag;
use Illuminate\Http\Request;

class PostTagRepository implements PostTagInterface
{
    /**
     * Attach a tag to a post
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

    /**
     * Detach a tag from a post
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
     * Update a tag attached to a post
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
     * Get tags associated with a post
     * @param Post $post
     * @return mixed
     */
    public function getTagsByPost(Post $post)
    {
        $tags = $post->tags;

        return response()->json([
            'tags' => $tags,
        ], 200);
    }
}
