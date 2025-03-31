<?php

declare(strict_types=1);

namespace App\Application\Contracts\DTO;

interface GatewayPaymentResponseInterface
{
    public function getStatus(): string;

    public function getPaymentId(): string;
}
