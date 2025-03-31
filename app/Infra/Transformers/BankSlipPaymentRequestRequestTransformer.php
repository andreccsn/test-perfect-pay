<?php

declare(strict_types=1);

namespace App\Infra\Transformers;

use App\Application\ValueObject\PaymentData;

class BankSlipPaymentRequestRequestTransformer implements PaymentRequestTransformerInterface
{
    private const PAYMENT_METHOD = 'BOLETO';

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
