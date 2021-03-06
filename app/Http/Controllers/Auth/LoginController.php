<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends ApiController
{
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $user = $this->userRepository->findOneBy(['email' => $credentials['email']]);
            if (!$user) {
                return $this->noFoundResponse('Konto o takim adresie e-mail nie istnieje');
            }

            if (Hash::check($credentials['password'], $user->password)) {
                $token = $user->createToken('Password Grant Client')->accessToken;

                return $this->successResponse('Zalogowano pomyślnie', [
                    'access_token' => $token,
                    'user' => $user
                ]);
            }

            return response()->json([
                'success' => self::ERROR_CODE,
                'message' => 'Hasło jest nieprawidłowe'
            ], Response::HTTP_FORBIDDEN);
        }catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
