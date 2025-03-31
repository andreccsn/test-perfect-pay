<?php

declare(strict_types=1);

namespace App\Infra\Repository\Database;

use App\Domain\Contracts\Repository\Database\CustomerRepositoryInterface;
use App\Domain\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByDocument(string $document): Customer|null
    {
        return Customer::where('document', preg_replace('/[^\d]/', '', $document))
            ->first();
    }
}
