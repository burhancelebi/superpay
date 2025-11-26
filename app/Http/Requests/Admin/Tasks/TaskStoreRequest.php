<?php

namespace App\Http\Requests\Admin\Tasks;

use App\enums\ActiveEnum;
use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaskStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'int', 'max:100', 'min:0'],
            'active' => ['nullable', 'boolean', new Enum(ActiveEnum::class)],
            'status' => ['sometimes', 'nullable', new Enum(TaskStatusEnum::class)],
            'type' => ['required', new Enum(TaskTypeEnum::class)],
            'score' => ['sometimes', 'nullable', 'integer', 'min:0', 'max:100'],
            'wallet_id' => ['nullable', 'integer', 'exists:wallets,id'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0', 'max:1000000'],
            'reward' => ['nullable', 'numeric', 'min:0', 'max:1000000']
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Görev başlığı zorunludur.',
            'title.string' => 'Görev başlığı metinsel bir ifade olmalıdır.',
            'title.max' => 'Görev başlığı en fazla 255 karakter olabilir.',

            'duration.required' => 'Süre alanı zorunludur.',
            'duration.int' => 'Süre alanı rakamsal bir değer olmalıdır.',
            'duration.max' => 'Süre değeri maksimum 100 olabilir.',
            'duration.min' => 'Süre değeri 0\'dan küçük olamaz.',

            'active.boolean' => 'Aktiflik durumu doğru formatta olmalıdır.',
            'active.enum' => 'Geçersiz aktiflik seçimi yapıldı.',

            'status.required' => 'Durum alanı zorunludur.',
            'status.enum' => 'Geçersiz durum seçimi yapıldı.',

            'type.required' => 'Görev türü alanı zorunludur.',
            'type.enum' => 'Geçersiz görev türü seçimi yapıldı.',

            'score.required' => 'Puan değeri zorunludur.',
            'score.integer' => 'Puan değeri sayısal olmalıdır.',
            'score.min' => 'Puan değeri 0\'dan küçük olamaz.',
            'score.max' => 'Puan değeri maksimum 100 olabilir.',

            'wallet_id.integer' => 'Cüzdan ID sayısal olmalıdır.',
            'wallet_id.exists' => 'Seçilen cüzdan sistemde mevcut değil.',

            'description.string' => 'Açıklama metinsel bir ifade olmalıdır.',
            'description.required' => 'Açıklama alanı zorunludur.',

            'amount.required' => 'Miktar alanı zorunludur.',
            'amount.numeric' => 'Miktar sayısal bir değer olmalıdır.',
            'amount.min' => 'Miktar 0\'dan küçük olamaz.',
            'amount.max' => 'Miktar en fazla 1.000.000 olabilir.',

            'reward.numeric' => 'Ödül sayısal bir değer olmalıdır.',
            'reward.min' => 'Ödül 0\'dan küçük olamaz.',
            'reward.max' => 'Ödül en fazla 100.000.000 olabilir.'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('active'), // Form'da 'active' adıyla gelebilir, modelde 'is_active' olabilir. Blade'de name="active" kullanmıştık.
        ]);
    }
}
