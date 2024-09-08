<?php

namespace App\Http\Controllers\Api\Category\Interface;

use App\Http\Controllers\Api\Category\Models\Category;

interface CategoryInterface
{
    public function all();
    public function create(array $data): Category;
    public function find($id): ?Category;
    public function update(array $data, $id): bool;
    public function delete($id): bool;
}
