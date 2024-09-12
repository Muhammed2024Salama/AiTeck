<?php

namespace App\Http\Controllers\Api\PostTag\Controllers;

use App\Http\Controllers\Api\Posts\Models\Post;
use App\Http\Controllers\Api\PostTag\Interface\PostTagInterface;
use App\Http\Controllers\Api\Tags\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    protected $postTagRepository;

    public function __construct(PostTagInterface $postTagRepository)
    {
        $this->postTagRepository = $postTagRepository;
    }

    /**
     * Attach a tag to a post
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function attachTag(Request $request, Post $post)
    {
        return $this->postTagRepository->attachTag($request, $post);
    }

    /**
     * Detach a tag from a post
     * @param Post $post
     * @param Tag $tag
     * @return mixed
     */
    public function detachTag(Post $post, Tag $tag)
    {
        return $this->postTagRepository->detachTag($post, $tag);
    }

    /**
     * Update a tag attached to a post
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function updateTag(Request $request, Post $post)
    {
        return $this->postTagRepository->updateTag($request, $post);
    }

    /**
     * Get tags associated with a post
     * @param Post $post
     * @return mixed
     */
    public function showTags(Post $post)
    {
        return $this->postTagRepository->getTagsByPost($post);
    }
}
