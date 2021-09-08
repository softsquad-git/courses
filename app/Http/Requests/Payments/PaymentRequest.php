<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        $rules['subscribe_id'] = 'required|integer';
        $rules['payment_type'] = 'required|string';

        if ($this->get('is_invoice')) {
            $rules['company_address'] = 'required|string';
            $rules['nip'] = 'required|string';
            $rules['company_name'] = 'required|string';
        }

        return $rules;
    }
}
