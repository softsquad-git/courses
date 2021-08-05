<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PromotionalCodeRequest extends FormRequest
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
    #[ArrayShape(['percent_minus' => "string", 'start_time' => "string", 'end_time' => "string"])] public function rules(): array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'percent_minus' => 'required|integer',
                'start_time' => 'required',
                'end_time' => 'required'
            ];
        }

        return $rules;
    }
}
