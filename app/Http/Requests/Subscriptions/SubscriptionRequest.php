<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class SubscriptionRequest extends FormRequest
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
    #[ArrayShape(['name' => "string", 'price' => "string", 'price_promo' => "string", 'unit' => "string"])] public function rules(): array
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules = [
                'name' => 'required|string',
                'price' => 'required',
                'price_promo' => 'nullable',
                'unit' => 'required|string'
            ];
        }

        return $rules;
    }
}
