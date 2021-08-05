<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\UpdateBasicDataRequest;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use App\Services\Users\UserSettingsService;
use Illuminate\Http\JsonResponse;
use \Exception;
use Illuminate\Support\Facades\Auth;

class SettingsController extends ApiController
{
    public function __construct(
        private UserRepository $userRepository,
        private UserSettingsService $userSettingsService
    )
    {
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        try {
            /**
             * @var User $user
             */
            $user = $this->userRepository->find(Auth::id());
            $this->userSettingsService->passwordUpdate($user, $request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * @param UpdateBasicDataRequest $request
     * @return JsonResponse
     */
    public function updateBasicData(UpdateBasicDataRequest $request): JsonResponse
    {
        try {
            $data = $request->only(['first_name', 'last_name', 'is_newsletter']);
            /**
             * @var User $user
             */
            $user = $this->userRepository->find(Auth::id());
            $this->userSettingsService->update($user, $data);

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
