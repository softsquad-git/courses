<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Users\UserResource;
use App\Repositories\Users\UserRepository;
use \Illuminate\Http\JsonResponse;
use \Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    /**
     * @return UserResource|JsonResponse
     */
    public function loggedUser(): UserResource|JsonResponse
    {
        try {
            $user = $this->userRepository->find(Auth::id());

            return new UserResource($user);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
