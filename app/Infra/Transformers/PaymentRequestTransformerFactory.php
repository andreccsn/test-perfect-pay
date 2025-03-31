<?php

declare(strict_types=1);

namespace App\Infra\Transformers;

use App\Domain\Enums\PaymentMethod;

class PaymentRequestTransformerFactory
{
    /**
     * @param PaymentMethod $paymentMethod
     * @return PaymentRequestTransformerInterface
     */
    public function fromPaymentMethod(PaymentMethod $paymentMethod): PaymentRequestTransformerInterface
    {
        return match ($paymentMethod) {
            PaymentMethod::BANK_SLIP => new BankSlipPaymentRequestRequestTransformer(),
            PaymentMethod::PIX => new PixPaymentRequestRequestTransformer(),
            PaymentMethod::CREDIT_CARD => new CreditCardPaymentRequestRequestTransformer(),
        };
    }
}
