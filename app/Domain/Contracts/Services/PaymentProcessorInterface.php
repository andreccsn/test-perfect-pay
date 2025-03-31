<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Services;

use App\Application\Contracts\DTO\GatewayPaymentResponseInterface;
use App\Application\ValueObject\PaymentData;

interface PaymentProcessorInterface
{
    /**
     * @param PaymentData $payment
     * @return GatewayPaymentResponseInterface
     */
    public function processPayment(PaymentData $payment): GatewayPaymentResponseInterface;
}
