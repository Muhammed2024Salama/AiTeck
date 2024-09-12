<?php

namespace App\Http\Controllers\Api\PostTag\Interface;

use App\Http\Controllers\Api\Posts\Models\Post;
use App\Http\Controllers\Api\Tags\Models\Tag;
use Illuminate\Http\Request;

interface PostTagInterface
{
    public function attachTag(Request $request, Post $post);
    public function detachTag(Post $post, Tag $tag);
    public function updateTag(Request $request, Post $post);
    public function getTagsByPost(Post $post);
}
