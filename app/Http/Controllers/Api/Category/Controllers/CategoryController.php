<?php

namespace App\Http\Controllers\Api\Category\Controllers;

use App\Http\Controllers\Api\Category\Interface\CategoryInterface;
use App\Http\Controllers\Api\Category\Requests\StoreCategoryRequest;
use App\Http\Controllers\Api\Category\Resources\CategoryResource;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->validated());

        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        return new CategoryResource($category);
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $this->categoryRepository->update($request->validated(), $id);

        $category = $this->categoryRepository->find($id);

        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
