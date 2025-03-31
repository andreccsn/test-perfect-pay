<?php

declare(strict_types=1);

namespace App\Infra\Contracts\Repository\Api;

use App\Application\ValueObject\Customer;

interface CustomerRepositoryApiInterface
{
    /**
     * Register a new customer.
     *
     * @param Customer $customer
     * @return mixed
     */
    public function registerCustomer(Customer $customer);
}
