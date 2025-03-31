<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\Contracts\DTO\GatewayPaymentResponseInterface;
use DateTime;

readonly class PixPaymentResponseDTO extends PaymentResponseDTO
{
    public function __construct(
        string $paymentId,
        string $status,
        private string $qrCodeImage,
        private string $qrCodeContent,
        private DateTime $expiration
    ) {
        parent::__construct(paymentId: $paymentId, status: $status);
    }

    public function getQrCodeImage(): string
    {
        return $this->qrCodeImage;
    }

    public function getQrCodeContent(): string
    {
        return $this->qrCodeContent;
    }

    public function getExpiration(): DateTime
    {
        return $this->expiration;
    }

    /**
     * @inheritDoc
     */
    public static function fromArray(array $data): GatewayPaymentResponseInterface
    {
        return new self(
            paymentId: $data['id'],
            status: $data['status'],
            qrCodeImage: $data['encodedImage'],
            qrCodeContent: $data['payload'],
            expiration: new DateTime($data['expirationDate'])
        );
    }
}
