<?php

namespace App\Http\Controllers\Api\Posts\Interface;

use Illuminate\Http\Request;

interface PostInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getAllPosts(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function createPost(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updatePost($id, array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function deletePost($id);
}
