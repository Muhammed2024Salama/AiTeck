<?php

namespace App\Http\Controllers\Api\Tags\Controllers;

use App\Http\Controllers\Api\Tags\Interface\TagInterface;
use App\Http\Controllers\Api\Tags\Requests\StoreTagRequest;
use App\Http\Controllers\Api\Tags\Resources\TagResource;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();
        return TagResource::collection($tags);
    }

    public function store(StoreTagRequest $request)
    {
        $tag = $this->tagRepository->create($request->validated());
        return new TagResource($tag);
    }

    public function show($id)
    {
        $tag = $this->tagRepository->find($id);
        return new TagResource($tag);
    }

    public function update(StoreTagRequest $request, $id)
    {
        $this->tagRepository->update($id, $request->validated());
        $tag = $this->tagRepository->find($id);
        return new TagResource($tag);
    }

    public function destroy($id)
    {
        $this->tagRepository->delete($id);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
