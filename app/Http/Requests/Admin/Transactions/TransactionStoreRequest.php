<?php

namespace App\Http\Requests\Admin\Transactions;

use App\Rules\ParentTransactionRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
            'parent_id' => [
                'nullable',
                'numeric',
                'exists:transactions,id',
                new ParentTransactionRule(),
            ],
            'transaction_group_id' => ['required', 'integer', 'exists:transaction_groups,id'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'reference_name' => ['nullable', 'string', 'max:255'],
            'requested_amount' => ['required', 'numeric', 'min:0'],
            'installment' => ['required', 'integer', 'min:1'],
            'payment_system_rate' => ['required', 'numeric', 'min:0'],
            'requested_at' => ['nullable', 'date'],
            'sent_at' => ['nullable', 'date'],
            'withdrawal_receipt' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'payment_receipt' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'amount_sent' => ['nullable', 'numeric', 'min:0'],

            'partial_payments' => ['nullable', 'array'],
            'partial_payments.*.amount' => ['required', 'numeric', 'min:0'],
            'partial_payments.*.paid_at' => ['nullable', 'date'],
            'partial_payments.*.description' => ['nullable', 'max:1000'],
            'partial_payments.*.file' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'parent_id.numeric' => 'Üst işlem numarası sayısal olmalıdır.',
            'parent_id.exists' => 'Belirtilen üst işlem bulunamadı.',

            'transaction_group_id.required' => 'İşlem grubu alanı zorunludur.',
            'transaction_group_id.integer' => 'İşlem grubu sayısal olmalıdır.',
            'transaction_group_id.exists' => 'Seçilen işlem grubu sistemde mevcut değil.',

            'customer_id.integer' => 'Müşteri alanı sayısal olmalıdır.',
            'customer_id.exists' => 'Seçilen müşteri sistemde mevcut değil.',

            'reference_name.string' => 'Referans adı metinsel olmalıdır.',
            'reference_name.max' => 'Referans adı en fazla 255 karakter olabilir.',
            'requested_amount.required' => 'Talep edilen tutar zorunludur.',
            'requested_amount.numeric' => 'Talep edilen tutar sayısal olmalıdır.',
            'requested_amount.min' => 'Talep edilen tutar 0\'dan küçük olamaz.',

            'installment.required' => 'Taksit sayısı zorunlu alandır.',
            'installment.integer' => 'Taksit sayısı sayısal olmalıdır.',
            'installment.min' => 'Taksit sayısı en az 1 olmalıdır.',

            'payment_system_rate.required' => 'Ödeme sistemi oranı alanı zorunludur.',
            'payment_system_rate.numeric' => 'Ödeme sistemi oranı sayısal olmalıdır.',
            'payment_system_rate.min' => 'Ödeme sistemi oranı negatif olamaz.',
            'payment_system_fee_amount.numeric' => 'Ödeme sistemi komisyon tutarı sayısal olmalıdır.',
            'payment_system_fee_amount.min' => 'Ödeme sistemi komisyon tutarı negatif olamaz.',
            'requested_at.date' => 'Talep edilen tarih geçerli bir tarih formatında olmalıdır.',
            'sent_at.date' => 'Gönderim tarihi geçerli bir tarih formatında olmalıdır.',

            'partial_payments.array' => 'Parçalı ödemeler dizi formatında gönderilmelidir.',
            'partial_payments.*.amount.required' => 'Parçalı ödeme tutarı zorunludur.',
            'partial_payments.*.amount.numeric' => 'Parçalı ödeme tutarı sayısal olmalıdır.',
            'partial_payments.*.amount.min' => 'Parçalı ödeme tutarı 0\'dan küçük olamaz.',
            'partial_payments.*.paid_at.date' => 'Parçalı ödeme tarihi geçerli bir tarih formatında olmalıdır.',
            'partial_payments.*.description.max' => 'Açıklama maksimum 1000 karakter olabilir.',
            'partial_payments.*.file.required' => 'Parçalı ödeme dekontu zorunludur.',
            'partial_payments.*.file.file' => 'Lütfen geçerli bir dosya yükleyin.',
            'partial_payments.*.file.mimes' => 'Dosya yalnızca JPG, PNG veya PDF formatında olabilir.',
            'partial_payments.*.file.max' => 'Dosya boyutu maksimum 10 MB olabilir.',

            'payment_receipt.file' => 'Lütfen geçerli bir dosya yükleyin.',
            'payment_receipt.mimes' => 'Dosya yalnızca JPG, PNG veya PDF formatında olabilir.',
            'payment_receipt.max' => 'Dosya boyutu maksimum 10 MB olabilir.',

            'withdrawal_receipt.required' => 'Çekim Dekont dosyası zorunludur.',
            'withdrawal_receipt.file' => 'Lütfen geçerli bir dosya yükleyin.',
            'withdrawal_receipt.mimes' => 'Dosya yalnızca JPG, PNG veya PDF formatında olabilir.',
            'withdrawal_receipt.max' => 'Dosya boyutu maksimum 10 MB olabilir.',
        ];
    }
}
