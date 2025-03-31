<?php

declare(strict_types=1);

namespace App\Domain\Factories;

use App\Domain\Contracts\Services\PaymentProcessorInterface;
use App\Domain\Enums\PaymentMethod;
use App\Domain\Services\BankSlipPaymentProcessor;
use App\Domain\Services\CreditCardPaymentProcessor;
use App\Domain\Services\PixPaymentProcessor;
use App\Infra\Contracts\Repository\Api\PaymentRepositoryApiInterface;
use App\Infra\Transformers\PaymentRequestTransformerFactory;

readonly class PaymentProcessorFactory
{
    /**
     * @param PaymentRepositoryApiInterface $apiRepository
     */
    public function __construct(
        private PaymentRepositoryApiInterface $apiRepository,
        private PaymentRequestTransformerFactory $paymentTransformFactory
    ) {
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return PaymentProcessorInterface
     * @throws \Exception
     */
    public function create(PaymentMethod $paymentMethod): PaymentProcessorInterface
    {
        $paymentTransform = $this->paymentTransformFactory->fromPaymentMethod($paymentMethod);

        return match ($paymentMethod) {
            PaymentMethod::BANK_SLIP => new BankSlipPaymentProcessor($this->apiRepository, $paymentTransform),
            PaymentMethod::PIX => new PixPaymentProcessor($this->apiRepository, $paymentTransform),
            PaymentMethod::CREDIT_CARD => new CreditCardPaymentProcessor($this->apiRepository, $paymentTransform),
        };
    }
}
