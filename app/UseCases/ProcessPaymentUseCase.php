<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Application\ValueObject\PaymentData;
use App\Domain\Enums\PaymentMethod;
use App\Domain\Enums\PaymentStatus;
use App\Domain\Factories\PaymentProcessorFactory;
use App\Domain\Models\Customer;
use App\Domain\Models\Transaction;

class ProcessPaymentUseCase
{
    /**
     * @param RegisterCustomerUseCase $registerCustomerUseCase
     * @param PaymentProcessorFactory $paymentProcessorFactory
     */
    public function __construct(
        private readonly RegisterCustomerUseCase $registerCustomerUseCase,
        private readonly PaymentProcessorFactory $paymentProcessorFactory
    ) {
    }

    /**
     * @param PaymentData $payment
     * @return Transaction
     * @throws \Exception
     */
    public function execute(PaymentData $payment): Transaction
    {
        try {
            $customer = $this->registerCustomerUseCase->execute($payment->getCustomer());
            $transaction = $this->initializeTransaction($payment, $customer);

            $paymentProcessor = $this->paymentProcessorFactory->create($payment->getPaymentMethod());
            $paymentResponse = $paymentProcessor->processPayment($payment);

            $transaction->gateway_reference_id = $paymentResponse->getPaymentId();
            $transaction->status = PaymentStatus::translateFromGateway($paymentResponse->getStatus())->value;

            switch ($transaction->payment_method) {
                case PaymentMethod::BANK_SLIP->value:
                    $transaction->bank_slip_link = $paymentResponse->getBankSlipUrl();
                    break;

                case PaymentMethod::PIX->value:
                    $transaction->qr_code = $paymentResponse->getQrCodeImage();
                    $transaction->qr_code_content = $paymentResponse->getQrCodeContent();
                    break;
            }

            $transaction->save();

            return $transaction;
        } catch (\Exception $exception) {
            $transaction->status = PaymentStatus::FAILED;
            $transaction->save();
            throw $exception;
        }
    }

    /**
     * @param PaymentData $payment
     * @param Customer $customer
     * @return Transaction
     */
    protected function initializeTransaction(PaymentData $payment, Customer $customer): Transaction
    {
        $transaction = new Transaction();
        $transaction->payment_method = $payment->getPaymentMethod()->value;
        $transaction->amount = $payment->getAmount()->getValue();
        $transaction->due_date = $payment->getDueDate();
        $transaction->status = PaymentStatus::INITIALIZED;
        $transaction->customer_id = $customer->id;
        $transaction->save();
        return $transaction;
    }
}
