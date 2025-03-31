<?php

declare(strict_types=1);

namespace App\UseCases;

use App\Application\ValueObject\Customer;
use App\Domain\Contracts\Repository\Database\CustomerRepositoryInterface;
use App\Domain\Models\Customer as CustomerModel;
use App\Infra\Contracts\Repository\Api\CustomerRepositoryApiInterface;

class RegisterCustomerUseCase
{
    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerRepositoryApiInterface $customerApiRepository
     */
    public function __construct(
        private readonly CustomerRepositoryInterface $customerRepository,
        private readonly CustomerRepositoryApiInterface $customerApiRepository,
    ) {
    }

    /**
     * @param Customer $customerDto
     * @return CustomerModel
     */
    public function execute(Customer $customerDto): CustomerModel
    {
        $customer = $this
            ->customerRepository
            ->findByDocument($customerDto->getDocument()->getValue());

        if (!$customer) {
            $customerFromGateway = $this->customerApiRepository->registerCustomer($customerDto);
            $customer = new CustomerModel();
            $customer->first_name = $customerDto->getFirstName();
            $customer->last_name = $customerDto->getLastName();
            $customer->document = $customerDto->getDocument()->getValue();
            $customer->document_type = $customerDto->getDocument()->getType();
            $customer->gateway_reference_id = $customerFromGateway['id'];
            $customer->save();
        }

        $customerDto->setGatewayId($customer->gateway_reference_id);
        return $customer;
    }
}
