<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum PaymentMethod: string
{
    case BANK_SLIP = 'bank_slip';
    case CREDIT_CARD = 'credit_card';
    case PIX = 'pix';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
