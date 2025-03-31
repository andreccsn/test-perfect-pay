<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Application\Contracts\DTO\GatewayPaymentResponseInterface;
use App\Application\DTO\PixPaymentResponseDTO;
use App\Application\ValueObject\PaymentData;
use App\Domain\Contracts\Services\PaymentProcessorInterface;
use App\Infra\Contracts\Repository\Api\PaymentRepositoryApiInterface;
use App\Infra\Transformers\PaymentRequestTransformerInterface;

class PixPaymentProcessor implements PaymentProcessorInterface
{
    public function __construct(
        private readonly PaymentRepositoryApiInterface $paymentApiRepository,
        private readonly PaymentRequestTransformerInterface $paymentTransform
    ) {
    }

    /**
     * @inheritDoc
     */
    public function processPayment(PaymentData $payment): GatewayPaymentResponseInterface
    {
        $paymentResponse = $this
            ->paymentApiRepository
            ->processPayment($this->paymentTransform->transform($payment));

        $pixContentResponse = $this->paymentApiRepository->getPixContent($paymentResponse['id']);
        return PixPaymentResponseDTO::fromArray(array_merge($paymentResponse, $pixContentResponse));
    }
}
