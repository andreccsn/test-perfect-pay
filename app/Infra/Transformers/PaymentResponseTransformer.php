<?php

namespace App\Infra\Transformers;

use App\Domain\Enums\PaymentMethod;
use App\Domain\Models\Transaction;

class PaymentResponseTransformer implements PaymentResponseTransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform(Transaction $transaction): array
    {
        $data = [
            'payment_method' => $transaction->payment_method,
            'status' => $transaction->status,
        ];

        switch ($transaction->payment_method) {
            case PaymentMethod::BANK_SLIP->value:
                $data['bank_slip_file'] = $transaction->bank_slip_link;
                break;

            case PaymentMethod::PIX->value:
                $data['qr_code_image'] = $transaction->qr_code;
                $data['qr_code_content'] = $transaction->qr_code_content;
                break;
        }

        return $data;
    }
}
