<?php

declare(strict_types=1);

namespace App\Application\ValueObject;

class Money
{
    private int $value;

    public function __construct(string $value)
    {
        $value = preg_replace('/[^\d]/', '', $value);
        $this->value = $value * 1;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
