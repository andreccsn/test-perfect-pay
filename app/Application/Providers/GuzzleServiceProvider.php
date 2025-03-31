<?php

declare(strict_types=1);

namespace App\Application\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;

class GuzzleServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singleton(ClientInterface::class, function ($app) {
            return new Client([
                'base_uri' => config('services.asaas.base_url'),
                'headers' => [
                    'access_token' => config('services.asaas.api_token'),
                    'Content-Type' => 'application/json',
                ],
            ]);
        });
    }
}
