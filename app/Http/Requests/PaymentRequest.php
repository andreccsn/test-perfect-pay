<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|string',
            'due_date' => 'required|date',
            'payment_method' => 'required|string|in:bank_slip,credit_card,pix',
            'customer.first_name' => 'required|string',
            'customer.last_name' => 'required|string',
            'customer.document' => ['required', 'string'],
        ];
    }
}
