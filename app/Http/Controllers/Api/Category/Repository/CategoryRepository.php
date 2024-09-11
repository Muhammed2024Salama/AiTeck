<?php

namespace App\Http\Controllers\Api\Category\Repository;

use App\Http\Controllers\Api\Category\Interface\CategoryInterface;
use App\Http\Controllers\Api\Category\Models\Category;

class CategoryRepository implements CategoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return Category::all();
    }

    /**
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * @param $id
     * @return Category|null
     */
    public function find($id): ?Category
    {
        return Category::findOrFail($id);
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id): bool
    {
        $category = $this->find($id);
        return $category->update($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $category = $this->find($id);
        return $category->delete();
    }
}
