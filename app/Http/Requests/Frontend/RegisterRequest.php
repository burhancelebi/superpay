<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'age' => ['required', 'integer', 'min:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],

            'bank_name' => ['required', 'array'],
            'bank_name.*' => ['required', 'string', 'max:255'],

            'iban' => ['required', 'array'],
            'iban.*' => ['required', 'string', 'max:34'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı zorunludur.',
            'name.string' => 'İsim alanı metin olmalıdır.',
            'name.max' => 'İsim en fazla 255 karakter olabilir.',

            'surname.required' => 'Soyisim alanı zorunludur.',
            'surname.string' => 'Soyisim metin olmalıdır.',
            'surname.max' => 'Soyisim en fazla 255 karakter olabilir.',

            'profession.required' => 'Meslek alanı zorunludur.',
            'profession.string' => 'Meslek metin olmalıdır.',
            'profession.max' => 'Meslek en fazla 255 karakter olabilir.',

            'phone.required' => 'Telefon numarası zorunludur.',
            'phone.string' => 'Telefon metin olmalıdır.',
            'phone.max' => 'Telefon en fazla 20 karakter olabilir.',

            'age.required' => 'Yaş alanı zorunludur.',
            'age.integer' => 'Yaş sayı olmalıdır.',
            'age.min' => 'Yaş en az 1 olmalıdır.',

            'email.required' => 'Email alanı zorunludur.',
            'email.string' => 'Email metin olmalıdır.',
            'email.email' => 'Geçerli bir email adresi giriniz.',
            'email.max' => 'Email en fazla 255 karakter olabilir.',
            'email.unique' => 'Bu email adresi zaten kayıtlıdır.',

            'password.required' => 'Şifre zorunludur.',
            'password.string' => 'Şifre metin olmalıdır.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifreler birbiriyle eşleşmiyor.',

            // Çoklu banka ve IBAN
            'bank_name.required' => 'Banka adı alanı zorunludur.',
            'bank_name.array' => 'Banka adı bir liste olmalıdır.',
            'bank_name.*.required' => 'Her banka için banka adı zorunludur.',
            'bank_name.*.string' => 'Her banka adı metin olmalıdır.',
            'bank_name.*.max' => 'Banka adı en fazla 255 karakter olabilir.',

            'iban.required' => 'IBAN alanı zorunludur.',
            'iban.array' => 'IBAN bir liste olmalıdır.',
            'iban.*.required' => 'Her banka için IBAN zorunludur.',
            'iban.*.string' => 'IBAN metin olmalıdır.',
            'iban.*.max' => 'IBAN en fazla 34 karakter olabilir.',
        ];
    }
}
