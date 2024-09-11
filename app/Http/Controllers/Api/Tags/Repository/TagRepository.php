<?php

namespace App\Http\Controllers\Api\Tags\Repository;

use App\Http\Controllers\Api\Tags\Interface\TagInterface;
use App\Http\Controllers\Api\Tags\Models\Tag;

class TagRepository implements TagInterface
{
    /**
     * @var Tag
     */
    protected $model;

    /**
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $tag = $this->model->findOrFail($id);
        $tag->update($data);
        return $tag;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $tag = $this->model->findOrFail($id);
        $tag->delete();
        return $tag;
    }
}
