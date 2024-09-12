<?php

namespace App\Http\Controllers\Api\Comments\Controllers;

use App\Http\Controllers\Api\Comments\Interface\CommentInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param $postId
     * @return mixed
     */
    public function index($postId)
    {
        return $this->commentRepository->getCommentsByPostId($postId);
    }

    /**
     * @param Request $request
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $postId)
    {
        return $this->commentRepository->createComment($request, $postId);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->commentRepository->deleteComment($id);
    }
}
