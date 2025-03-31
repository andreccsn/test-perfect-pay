<?php

declare(strict_types=1);

namespace App\Infra\Transformers;

use App\Application\ValueObject\PaymentData;

interface PaymentRequestTransformerInterface
{
    /**
     * Create payment method request payload.
     *
     * @param PaymentData $payment
     * @return array
     */
    public function transform(PaymentData $payment): array;
}
