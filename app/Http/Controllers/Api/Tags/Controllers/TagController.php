<?php

namespace App\Http\Controllers\Api\Tags\Controllers;

use App\Http\Controllers\Api\Tags\Interface\TagInterface;
use App\Http\Controllers\Api\Tags\Requests\StoreTagRequest;
use App\Http\Controllers\Api\Tags\Resources\TagResource;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * @param TagInterface $tagRepository
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tags = $this->tagRepository->all();
        return TagResource::collection($tags);
    }

    /**
     * @param StoreTagRequest $request
     * @return TagResource
     */
    public function store(StoreTagRequest $request)
    {
        $tag = $this->tagRepository->create($request->validated());
        return new TagResource($tag);
    }

    /**
     * @param $id
     * @return TagResource
     */
    public function show($id)
    {
//        dd($id);
        $tag = $this->tagRepository->find($id);
        return new TagResource($tag);
    }

    /**
     * @param StoreTagRequest $request
     * @param $id
     * @return TagResource
     */
    public function update(StoreTagRequest $request, $id)
    {
        $this->tagRepository->update($id, $request->validated());
        $tag = $this->tagRepository->find($id);
        return new TagResource($tag);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->tagRepository->delete($id);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
