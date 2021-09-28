<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UserAudioRequest extends FormRequest
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
    #[ArrayShape(['lesson_id' => "string", 'file' => "string"])] public function rules(): array
    {
        return [
            'lesson_id' => 'required|integer',
            'file' => 'string'
        ];
    }
}
