<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Repository\Database;

use App\Domain\Models\Customer;

interface CustomerRepositoryInterface
{
    /**
     * Retrieve a Customer by document from database.
     *
     * @param string $document
     * @return Customer|null
     */
    public function findByDocument(string $document): Customer|null;
}
