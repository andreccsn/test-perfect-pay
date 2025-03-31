<?php

namespace App\Infra\Transformers;

use App\Application\ValueObject\PaymentData;

class CreditCardPaymentRequestRequestTransformer implements PaymentRequestTransformerInterface
{
    private const PAYMENT_METHOD = 'CREDIT_CARD';

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
            'creditCard' => [
                'holderName' => $payment->getCreditCard()->getHolderName(),
                'number' => $payment->getCreditCard()->getNumber(),
                'expiryMonth' => substr($payment->getCreditCard()->getExpiration(), 0, 2),
                'expiryYear' => substr($payment->getCreditCard()->getExpiration(), -4),
                'ccv' => $payment->getCreditCard()->getCvv()
            ],
            'creditCardHolderInfo' => [
                'name' => $payment->getCustomer()->getName(),
                'email' => $payment->getBilling()->getEmail(),
                'cpfCnpj' => $payment->getCustomer()->getDocument()->getValue(),
                'postalCode' => $payment->getBilling()->getPostalCode(),
                'addressNumber' => $payment->getBilling()->getAddressNumber(),
                'phone' => $payment->getBilling()->getPhone()
            ]
        ];
    }
}
