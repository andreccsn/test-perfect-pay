<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

class Customer
{
    private ?string $gatewayId = null;

    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly CustomerDocument $document
    ) {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDocument(): CustomerDocument
    {
        return $this->document;
    }

    /**
     * Returns customer full name.
     * @return string
     */
    public function getName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new Customer(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            document: new CustomerDocument($data['document'])
        );
    }

    public function getGatewayId(): ?string
    {
        return $this->gatewayId;
    }

    public function setGatewayId(string $id)
    {
        $this->gatewayId = $id;
    }
}
