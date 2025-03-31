<?php

declare(strict_types=1);

namespace App\Application\Http\Requests;

use App\Application\Contracts\Http\Requests\RequestInterface;
use App\Domain\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest implements RequestInterface
{
    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        $rules = [
            'amount' => 'required|string|regex:/[0-9\.,]+/',
            'due_date' => 'required|date',
            'payment_method' => 'required|string|in:bank_slip,credit_card,pix',
            'customer.first_name' => 'required|string',
            'customer.last_name' => 'required|string',
            'customer.document' => 'required|string',
        ];

        if ($this->input('payment_method') == 'credit_card') {
            $rules = array_merge($rules, $this->getCreditCardRules());
        }

        return $rules;
    }

    protected function getCreditCardRules(): array
    {
        return [
            'credit_card' => 'required',
            'credit_card.holder_name' => 'required|string',
            'credit_card.number' => 'required|string',
            'credit_card.expiration' => 'required|regex:/([\d]{2})\/([\d]{4})$/',
            'credit_card.cvv' => 'required|string',
            'billing.email' => 'required|email',
            'billing.address_number' => 'required|string',
            'billing.postal_code' => 'required|regex:/([\d]{5})-([\d]{3})$/',
            'billing.phone' => 'required|regex:/^\(\d{2}\) \d{4,5}-\d{4}$/',
        ];
    }
}
