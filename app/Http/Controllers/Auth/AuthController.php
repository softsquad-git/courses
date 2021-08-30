<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $token = Auth::user()->token();
            $token = $request->user()->tokens->find($token);
            $token->revoke();

            return $this->successResponse('Wylogowano pomyślnie');
        }
    }
}
