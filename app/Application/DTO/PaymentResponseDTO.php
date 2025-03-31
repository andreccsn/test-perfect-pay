<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\Contracts\DTO\GatewayPaymentResponseInterface;

readonly abstract class PaymentResponseDTO implements GatewayPaymentResponseInterface
{
    public function __construct(
        private string $paymentId,
        private string $status
    ) {
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    /**
     * @param array $data
     * @return self
     */
    abstract public static function fromArray(array $data): GatewayPaymentResponseInterface;
}
