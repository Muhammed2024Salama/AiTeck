<?php

namespace App\Http\Controllers\Api\Category\Controllers;

use App\Http\Controllers\Api\Category\Interface\CategoryInterface;
use App\Http\Controllers\Api\Category\Requests\StoreCategoryRequest;
use App\Http\Controllers\Api\Category\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Api\Category\Resources\CategoryResource;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * @var CategoryInterface
     */
    protected $categoryRepository;

    /**
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();
        return CategoryResource::collection($categories);
    }

    /**
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @param $id
     * @return CategoryResource
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        return new CategoryResource($category);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param $id
     * @return CategoryResource
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        // dd($request->all());
        $this->categoryRepository->update($request->validated(), $id);

        $category = $this->categoryRepository->find($id);

        return new CategoryResource($category);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
