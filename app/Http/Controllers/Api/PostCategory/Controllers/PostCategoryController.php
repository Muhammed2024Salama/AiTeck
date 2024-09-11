<?php

namespace App\Http\Controllers\Api\PostCategory\Controllers;

use App\Http\Controllers\Api\Category\Models\Category;
use App\Http\Controllers\Api\Posts\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function attachCategory(Request $request, Post $post)
    {
        $categoryId = $request->input('category_id');
        $category = Category::findOrFail($categoryId);

        $post->categories()->attach($categoryId);

        return response()->json([
            'message' => 'Category attached to post successfully.',
        ], 200);
    }

    /**
     * @param Post $post
     * @param Category $category
     * @return mixed
     */
    public function detachCategory(Post $post, Category $category)
    {
        $post->categories()->detach($category->id);

        return response()->json([
            'message' => 'Category detached from post successfully.',
        ], 200);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return mixed
     */
    public function updateCategory(Request $request, Post $post)
    {
        $newCategoryId = $request->input('new_category_id');
        $oldCategoryId = $request->input('old_category_id');

        $newCategory = Category::findOrFail($newCategoryId);
        $oldCategory = Category::findOrFail($oldCategoryId);

        $post->categories()->detach($oldCategoryId);

        $post->categories()->attach($newCategoryId);

        return response()->json([
            'message' => 'Category updated successfully.',
        ], 200);
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function showCategories(Post $post)
    {
        $categories = $post->categories;

        return response()->json([
            'categories' => $categories,
        ], 200);
    }
}
