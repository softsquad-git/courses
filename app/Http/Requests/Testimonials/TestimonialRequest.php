<?php

namespace App\Http\Requests\Testimonials;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class TestimonialRequest extends FormRequest
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
    #[ArrayShape(['content' => "string", 'author' => "string"])] public function rules(): array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'content' => 'required|string',
                'author' => 'required|string'
            ];
        }

        return $rules;
    }
}
