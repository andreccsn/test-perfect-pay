<?php

namespace App\Application\Providers;

use App\Domain\Contracts\Repository\Database\CustomerRepositoryInterface;
use App\Infra\Contracts\Repository\Api\CustomerRepositoryApiInterface;
use App\Infra\Contracts\Repository\Api\PaymentRepositoryApiInterface;
use App\Infra\Repository\Api\Asaas\CustomerRepository as CustomerApiRepository;
use App\Infra\Repository\Api\Asaas\PaymentRepository;
use App\Infra\Repository\Database\CustomerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerRepositoryApiInterface::class, CustomerApiRepository::class);
        $this->app->bind(PaymentRepositoryApiInterface::class, PaymentRepository::class);
    }
}
