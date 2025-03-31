<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

use App\Domain\Enums\PaymentMethod;
use DateTime;

class PaymentData
{
    public function __construct(
        private readonly PaymentMethod $paymentMethod,
        private readonly Money $amount,
        private readonly DateTime $dueDate,
        private readonly Customer $customer,
        private readonly ?CreditCard $creditCard,
        private readonly ?Billing $billing
    ) {
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getBilling(): ?Billing
    {
        return $this->billing;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $creditCard = $data['payment_method'] == 'credit_card' ? CreditCard::fromArray($data['credit_card']) : null;
        $billing = $data['payment_method'] == 'credit_card' ? Billing::fromArray($data['billing']) : null;

        return new PaymentData(
            paymentMethod: PaymentMethod::tryFrom($data['payment_method']),
            amount: new Money($data['amount']),
            dueDate: DateTime::createFromFormat('d/m/Y', $data['due_date']),
            customer: Customer::fromArray($data['customer']),
            creditCard: $creditCard,
            billing: $billing
        );
    }
}
