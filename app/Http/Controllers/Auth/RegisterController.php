<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Users\RegisterService;
use Illuminate\Http\JsonResponse;
use \Exception;

class RegisterController extends ApiController
{
    /**
     * @var RegisterService $registerService
     */
    private RegisterService $registerService;

    /**
     * @param RegisterService $registerService
     */
    public function __construct(
        RegisterService $registerService
    )
    {
        $this->registerService = $registerService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $this->registerService->save($request->all());

            return $this->createdResponse();
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
