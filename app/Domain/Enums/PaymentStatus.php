<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum PaymentStatus: string
{
    case INITIALIZED = 'initialized';
    case AUTHORIZED = 'authorized';
    case FAILED = 'failed';
    case PAID = 'paid';
    case PENDING = 'pending';

    public static function translateFromGateway(string $gatewayStatus): self
    {
        return match ($gatewayStatus) {
            'PAYMENT_CONFIRMED', 'CONFIRMED' => self::PAID,
            'PAYMENT_AUTHORIZED', 'AUTHORIZED' => self::AUTHORIZED,
            default => self::PENDING
        };
    }
}
