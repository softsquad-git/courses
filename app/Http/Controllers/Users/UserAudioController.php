<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Users\UserAudioRequest;
use App\Http\Resources\Users\UserAudioResource;
use App\Repositories\Users\UserAudioRepository;
use App\Services\Users\UserAudioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class UserAudioController extends ApiController
{
    /**
     * @param UserAudioRepository $userAudioRepository
     * @param UserAudioService $userAudioService
     */
    public function __construct(
        private UserAudioRepository $userAudioRepository,
        private UserAudioService $userAudioService
    )
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
        $data = $this->userAudioRepository->findBy(['user_id' => Auth::id()]);

        return UserAudioResource::collection($data);
    }

    /**
     * @param UserAudioRequest $request
     * @return JsonResponse
     */
    public function create(UserAudioRequest $request): JsonResponse
    {
        $this->userAudioService->save($request->all());

        return $this->createdResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $item = $this->userAudioRepository->findByOne(['lesson_id' => $id, 'user_id' => Auth::id()]);
        if (!$item) {
            return $this->noFoundResponse();
        }

        $this->userAudioService->remove($item);

        return $this->deletedResponse();
    }
}
