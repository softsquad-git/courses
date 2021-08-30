<?php

namespace App\Http\Requests\Users\Courses;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UserRerunsRequest extends FormRequest
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
    #[ArrayShape(['exercise_id' => 'int'])] public function rules(): array
    {
        return [
            'exercise_id' => 'required|integer'
        ];
    }
}
