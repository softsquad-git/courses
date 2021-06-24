<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UsersResource;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends ApiController
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function all(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $data = $this->userRepository->findBy(
                $request->all(),
                $request->get('ordering', 'DESC'),
                $request->get('pagination', 20)
            );

            return UsersResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return UserResource|JsonResponse
     */
    public function find(int $id): UserResource|JsonResponse
    {
        try {
            $item = $this->userRepository->find($id);

            return new UserResource($item);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
