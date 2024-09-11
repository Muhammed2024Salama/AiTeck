<?php

namespace App\Http\Controllers\Api\Users\Controllers;

use App\Http\Controllers\Api\Users\Interface\UserInterface;
use App\Http\Controllers\Api\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Api\Users\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository->getAllUsers();
        return UserResource::collection($users)->response();
    }

    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = $this->userRepository->storeUser($validated);
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        $user = $this->userRepository->getUserById($user);
        return (new UserResource($user))->response();
    }

    /**
     * @param StoreUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(StoreUserRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        $user = $this->userRepository->updateUser($validated, $user);
        return (new UserResource($user))->response();
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userRepository->deleteUser($user);
        return response()->json(null, 204);
    }
}
