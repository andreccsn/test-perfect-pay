<?php

declare(strict_types=1);

namespace App\Application\Providers;

use App\Domain\Contracts\Services\PaymentProcessorInterface;
use App\Domain\Enums\PaymentMethod;
use App\Domain\Factories\PaymentProcessorFactory;
use App\Infra\Contracts\Repository\Api\PaymentRepositoryApiInterface;
use Illuminate\Support\ServiceProvider;

class PaymentProcessorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (request()->has('payment_method')) {
            $this->app->bind(PaymentProcessorInterface::class, function ($app) {
                $paymentProcessorFactory = new PaymentProcessorFactory($app->get(PaymentRepositoryApiInterface::class));
                $paymentMethod = PaymentMethod::tryFrom(request()->input('payment_method'));
                return $paymentProcessorFactory->create($paymentMethod);
            });
        }
    }
}
