<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class HomeInformationRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'title' => 'required|string',
                'content' => 'required|string'
            ];
        }

        return $rules;
    }
}
