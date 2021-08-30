<?php

namespace App\Http\Controllers\Users\Courses;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Users\Courses\UserRerunsRequest;
use App\Http\Resources\Users\UserRerunsResource;
use App\Models\Users\UserRerun;
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
            $data = $this->userRerunsRepository->findBy(['user_id' => Auth::id()], false);

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

    /**
     * @param int $exerciseId
     * @return JsonResponse
     */
    public function check(int $exerciseId): JsonResponse
    {
        try {
            /**
             * @var UserRerun|null $item
             */
            $item = $this->userRerunsRepository->findOneBy([
                'user_id' => Auth::id(),
                'exercise_id' => $exerciseId
            ]);

            if ($item) {
                return response()->json([
                    'success' => 1,
                    'message' => 'Usuń z powtórek',
                    'code' => true,
                    'rerunId' => $item->id
                ], 200);
            }

            return response()->json([
                'success' => 1,
                'message' => 'Dodaj do powtórek',
                'code' => false,
                'rerunId' => null
            ], 200);
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @return UserRerunsResource
     */
    public function firstRerun(): UserRerunsResource
    {
        $item = $this->userRerunsRepository->findOneBy([
            'user_id' => Auth::id()
        ]);

        return new UserRerunsResource($item);
    }

    /**
     * @param int $currentId
     * @return UserRerunsResource|JsonResponse
     */
    public function nextRerun(int $currentId): UserRerunsResource|JsonResponse
    {
        $item = $this->userRerunsRepository->nextRerun($currentId);

        if (!$item) {
            return response()->json([
                'success' => 0,
                'message' => 'Brak kolejnej powtórki',
                'code' => 404
            ], 200);
        }

        return new UserRerunsResource($item);
    }

}
