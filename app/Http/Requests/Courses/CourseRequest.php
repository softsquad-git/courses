<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CourseRequest extends FormRequest
{
    /***
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    #[ArrayShape(['name' => "string", 'level_id' => "string", 'language_id' => "string", 'is_active' => "string"])] public function rules():array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'name' => 'required|string',
                'level_id' => 'required|integer',
                'language_id' => 'required|integer',
                'is_active' => 'required|integer'
            ];
        }

        return $rules;
    }
}
