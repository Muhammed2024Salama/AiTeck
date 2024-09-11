<?php

namespace App\Http\Controllers\Api\Posts\Repository;

use App\Http\Controllers\Api\Posts\Interface\PostInterface;
use App\Http\Controllers\Api\Posts\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostRepository implements PostInterface
{
    /**\
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAllPosts(Request $request)
    {
        $query = Post::query();

        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        return $query->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createPost(array $data)
    {
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => Str::slug($data['title']),
            'author_id' => auth()->id(),
            'published_at' => now(),
        ]);

        $post->categories()->attach($data['categories']);
        $post->tags()->attach($data['tags']);

        return $post;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updatePost($id, array $data)
    {
        $post = Post::findOrFail($id);

        $post->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => Str::slug($data['title']),
            'published_at' => now(),
        ]);

        $post->categories()->sync($data['categories']);
        $post->tags()->sync($data['tags']);

        return $post;
    }

    /**
     * @param $id
     * @return void
     */
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    }
}
