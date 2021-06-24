<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    #[ArrayShape(['email' => "string", 'password' => "string"])] public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ];
    }
}
