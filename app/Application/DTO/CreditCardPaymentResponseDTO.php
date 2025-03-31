<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\Contracts\DTO\GatewayPaymentResponseInterface;

readonly class CreditCardPaymentResponseDTO extends PaymentResponseDTO
{
    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): GatewayPaymentResponseInterface
    {
        return new self(paymentId: $data['id'], status: $data['status']);
    }
}
