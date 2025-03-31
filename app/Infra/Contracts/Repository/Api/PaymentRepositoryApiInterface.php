<?php

declare(strict_types=1);

namespace App\Infra\Contracts\Repository\Api;

interface PaymentRepositoryApiInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function processPayment(array $data): array;
}
