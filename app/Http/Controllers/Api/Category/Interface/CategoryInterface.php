<?php

namespace App\Http\Controllers\Api\Category\Interface;

use App\Http\Controllers\Api\Category\Models\Category;

interface CategoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category;

    /**
     * @param $id
     * @return Category|null
     */
    public function find($id): ?Category;

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id): bool;

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool;
}

