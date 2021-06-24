<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Users\UserResource;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\JsonResponse;
use \Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserResource|JsonResponse
     */
    public function findLoggedUser(): UserResource|JsonResponse
    {
        try {
            $item = $this->userRepository->find(Auth::id());

            return new UserResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
