<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CourseLessonFlashcardRequest extends FormRequest
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
    #[ArrayShape(['lesson_id' => "string", 'txt' => "string", 'txt_trans' => "string", 'image' => "string", 'sound_file' => "string"])] public function rules(): array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'lesson_id' => 'required|integer',
                'txt' => 'required|string',
                'txt_trans' => 'required|string',
                'image' => 'required',
                'sound_file' => 'required'
            ];
        }

        return $rules;
    }
}
