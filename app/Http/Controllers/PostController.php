<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
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

        $posts = $query->get();

        return response()->json(PostResource::collection($posts));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|unique:posts',
            'categories' => 'required',
            'tags' => 'required',
        ]);

         $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['slug'],
            'author_id' => auth()->id(),
            'published_at' => now()
        ]);

        $post->categories()->attach($validatedData['categories']);
        $post->tags()->attach($validatedData['tags']);

        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|unique:posts,slug,' . $post->id,
            'categories' => 'required|array',
            'tags' => 'required|array',
        ]);

        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $validatedData['slug'],
            'published_at' => now()
        ]);

        // Sync categories and tags (detach the old and attach the new ones)
        $post->categories()->sync($validatedData['categories']);
        $post->tags()->sync($validatedData['tags']);

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
