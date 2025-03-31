<?php

declare(strict_types=1);

namespace App\Infra\Repository\Api\Asaas;

use App\Application\ValueObject\Customer;
use App\Infra\Contracts\Repository\Api\CustomerRepositoryApiInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class CustomerRepository implements CustomerRepositoryApiInterface
{
    private const CUSTOMER_API_RESOURCE = 'customers';

    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(private readonly ClientInterface $httpClient)
    {
    }

    /**
     * @inheritDoc
     */
    public function registerCustomer(Customer $customer)
    {
        $data = [
            'name' => $customer->getName(),
            'cpfCnpj' => $customer->getDocument()->getValue()
        ];

        try {
            $response = $this->httpClient
                ->request('post', self::CUSTOMER_API_RESOURCE, ['json' => $data]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $exception) {
            throw $exception;
        }
    }
}
