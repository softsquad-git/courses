<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingAppRequest extends FormRequest
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
                'name' => 'required|string',
                'value' => 'required'
            ];
        }

        return $rules;
    }
}
