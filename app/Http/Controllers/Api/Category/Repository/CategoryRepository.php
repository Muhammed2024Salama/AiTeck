<?php

namespace App\Http\Controllers\Api\Category\Repository;

use App\Http\Controllers\Api\Category\Interface\CategoryInterface;
use App\Http\Controllers\Api\Category\Models\Category;

class CategoryRepository implements CategoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function find($id): ?Category
    {
        return Category::findOrFail($id);
    }

    public function update(array $data, $id): bool
    {
        $category = $this->find($id);
        return $category->update($data);
    }

    public function delete($id): bool
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
