<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\Contracts\DTO\GatewayPaymentResponseInterface;

readonly class BankSlipPaymentResponseDTO extends PaymentResponseDTO
{
    public function __construct(
        string $paymentId,
        string $status,
        private string $bankSlipUrl
    ) {
        parent::__construct(paymentId: $paymentId, status: $status);
    }

    public function getBankSlipUrl(): string
    {
        return $this->bankSlipUrl;
    }

    public static function fromArray(array $data): GatewayPaymentResponseInterface
    {
        return new self(
            paymentId: $data['id'],
            status: $data['status'],
            bankSlipUrl: $data['bankSlipUrl']
        );
    }
}
