<?php

declare(strict_types=1);

namespace App\Infra\Transformers;

use App\Domain\Models\Transaction;

interface PaymentResponseTransformerInterface
{
    /**
     * @param Transaction $transaction
     * @return array
     */
    public function transform(Transaction $transaction): array;
}
