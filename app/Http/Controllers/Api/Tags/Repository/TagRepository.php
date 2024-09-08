<?php

namespace App\Http\Controllers\Api\Tags\Repository;

use App\Http\Controllers\Api\Tags\Interface\TagInterface;
use App\Http\Controllers\Api\Tags\Models\Tag;

class TagRepository implements TagInterface
{
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $tag = $this->model->findOrFail($id);
        $tag->update($data);
        return $tag;
    }

    public function delete($id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->delete();
        return $tag;
    }
}
