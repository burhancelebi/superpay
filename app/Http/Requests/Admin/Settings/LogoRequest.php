<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

class LogoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];

        if (request()->isMethod('PUT'))
        {
            $rules = [
                'logo-title'         => 'required|max:100',
            ];

            if (request()->has('logo-image'))
            {
                $rules['logo-image'] = 'image|mimes:png,jpg,jpeg|max:8000';
            }
        }

        return $rules;
    }
}
