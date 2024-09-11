<?php

namespace App\Http\Controllers\Api\Posts\Controllers;

use App\Http\Controllers\Api\Posts\Interface\PostInterface;
use App\Http\Controllers\Api\Posts\Requests\StorePostRequest;
use App\Http\Controllers\Api\Posts\Requests\UpdatePostRequest;
use App\Http\Controllers\Api\Posts\Resources\PostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @var PostInterface
     */
    protected $postRepository;

    /**
     * @param PostInterface $postRepository
     */
    public function __construct(PostInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->getAllPosts($request);
        return response()->json(PostResource::collection($posts));
    }

    /**
     * @param $id
     * @return PostResource
     */
    public function show($id)
    {
        $post = $this->postRepository->getPostById($id);
        return new PostResource($post);
    }

    /**
     * @param StorePostRequest $request
     * @return PostResource
     */
    public function store(StorePostRequest $request) // External validation
    {
        $post = $this->postRepository->createPost($request->validated());
        return new PostResource($post);
    }

    /**
     * @param UpdatePostRequest $request
     * @param $id
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, $id) // External validation
    {
        $post = $this->postRepository->updatePost($id, $request->validated());
        return new PostResource($post);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->postRepository->deletePost($id);
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
