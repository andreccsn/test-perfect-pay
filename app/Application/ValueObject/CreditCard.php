<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

readonly class CreditCard
{
    public function __construct(
        private string $holderName,
        private string $number,
        private string $expiration,
        private string $cvv
    ) {
    }

    public function getHolderName(): string
    {
        return $this->holderName;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getExpiration(): string
    {
        return $this->expiration;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            holderName: $data['holder_name'],
            number: preg_replace('/\s+/', '', $data['number']),
            expiration: $data['expiration'],
            cvv: $data['cvv']
        );
    }
}
