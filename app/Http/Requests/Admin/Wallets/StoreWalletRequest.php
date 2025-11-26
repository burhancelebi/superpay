<?php

namespace App\Http\Requests\Admin\Wallets;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'network' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'active' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'network.required' => 'Ağ (network) bilgisi zorunludur.',
            'network.string' => 'Ağ bilgisi metin formatında olmalıdır.',
            'network.max' => 'Ağ bilgisi en fazla 255 karakter olabilir.',
            'currency.required' => 'Para birimi zorunludur.',
            'currency.string' => 'Para birimi metin formatında olmalıdır.',
            'currency.max' => 'Para birimi en fazla 255 karakter olabilir.',
            'address.required' => 'Cüzdan adresi zorunludur.',
            'address.string' => 'Cüzdan adresi metin formatında olmalıdır.',
            'address.max' => 'Cüzdan adresi en fazla 255 karakter olabilir.',
            'active.required' => 'Aktiflik durumu seçilmelidir.',
            'active.boolean' => 'Aktiflik durumu sadece aktif veya pasif olabilir.',
        ];
    }
}
