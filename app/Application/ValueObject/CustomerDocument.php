<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

use InvalidArgumentException;

class CustomerDocument
{
    private const TYPE_CPF = 'cpf';
    private const TYPE_CNPJ = 'cnpj';
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $value = preg_replace('/[^\d]/', '', $value);
        if (strlen($value) != 11 && strlen($value) != 14) {
            throw new InvalidArgumentException(sprintf('%s não é um documento válido', $value));
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return strlen($this->value) == 11 ? self::TYPE_CPF : self::TYPE_CNPJ;
    }
}
