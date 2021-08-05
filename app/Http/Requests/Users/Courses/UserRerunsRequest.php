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
    #[ArrayShape(['txt' => "string", 'txt_trans' => "string", 'sound_file' => "string"])] public function rules(): array
    {
        return [
            'txt' => 'required|string',
            'txt_trans' => 'required|string',
            'sound_file' => 'required|string'
        ];
    }
}
