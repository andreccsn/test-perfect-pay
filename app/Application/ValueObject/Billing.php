<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

readonly class Billing
{
    public function __construct(
        private string $email,
        private string $postalCode,
        private string $addressNumber,
        private string $phone,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new Billing(
            $data['email'],
            $data['postal_code'],
            $data['address_number'],
            $data['phone']
        );
    }
}
