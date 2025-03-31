<?php

namespace App\Infra\Transformers;

use App\Application\ValueObject\PaymentData;

class PixPaymentRequestRequestTransformer implements PaymentRequestTransformerInterface
{
    private const PAYMENT_METHOD = 'PIX';

    /**
     * @inheritDoc
     */
    public function transform(PaymentData $payment): array
    {
        return [
            'customer' => $payment->getCustomer()->getGatewayId(),
            'billingType' => self::PAYMENT_METHOD,
            'value' => $payment->getAmount()->getValue() / 100,
            'dueDate' => $payment->getDueDate()->format('Y-m-d'),
        ];
    }
}
