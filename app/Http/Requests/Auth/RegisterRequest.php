<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RegisterRequest extends FormRequest
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
    #[ArrayShape([
        'first_name' => "string",
        'last_name' => "string",
        'email' => "string",
        'password' => "string",
        'is_terms' => "string",
        'is_newsletter' => "string",
        'avatar' => "string"
    ])] public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'is_terms' => 'required',
            'is_newsletter' => 'nullable|integer',
            'avatar' => 'nullable'
        ];
    }
}
