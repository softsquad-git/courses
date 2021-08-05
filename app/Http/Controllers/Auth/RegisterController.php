<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Users\RegisterService;
use \Exception;
use Illuminate\Http\JsonResponse;

class RegisterController extends ApiController
{
    /**
     * @param RegisterService $registerService
     */
    public function __construct(
        private RegisterService $registerService
    )
    {
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $this->registerService->save($request->all());

            return $this->successResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
