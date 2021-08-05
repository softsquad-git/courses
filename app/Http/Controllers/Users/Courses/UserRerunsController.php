<?php

namespace App\Http\Controllers\Users\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Courses\UserRerunsRequest;
use App\Http\Resources\Users\UserRerunsResource;
use App\Repositories\Users\UserRerunsRepository;
use App\Services\Users\UserRerunsService;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use \Exception;
use Illuminate\Support\Facades\Auth;

class UserRerunsController extends ApiController
{
    /**
     * @param UserRerunsRepository $userRerunsRepository
     * @param UserRerunsService $userRerunsService
     */
    public function __construct(
        private UserRerunsRepository $userRerunsRepository,
        private UserRerunsService $userRerunsService
    )
    {
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function all(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $data = $this->userRerunsRepository->findBy(['user_id' => Auth::id()], true);

            return UserRerunsResource::collection($data);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param UserRerunsRequest $request
     * @return JsonResponse
     */
    public function create(UserRerunsRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $this->userRerunsService->save($data);

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        try {
            $item = $this->userRerunsRepository->find($id);
            $this->userRerunsService->remove($item);

            return $this->deletedResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
