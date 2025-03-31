<?php

declare(strict_types=1);

namespace App\Infra\Repository\Api\Asaas;

use App\Infra\Contracts\Repository\Api\PaymentRepositoryApiInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class PaymentRepository implements PaymentRepositoryApiInterface
{
    private const PAYMENT_API_RESOURCE = 'payments';

    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(private readonly ClientInterface $httpClient)
    {
    }

    /**
     * @inheritDoc
     */
    public function processPayment(array $data): array
    {
        try {
            $response = $this->httpClient
                ->request('post', self::PAYMENT_API_RESOURCE, ['json' => $data]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            Log::error('Erro ao processar pagamento.', [
                'request' => $data,
                'response' => [
                    'status' => $response->getStatusCode(),
                    'type' => $response->getReasonPhrase(),
                    'data' => json_decode($response->getBody()->getContents(), true)
                ]
            ]);
            throw $exception;
        } catch (GuzzleException $exception) {

        }
    }

    /**
     * Retrieve pix payment info like QR Code image, QR Code content and expiration date
     * @param string $paymentId
     * @return array
     */
    public function getPixContent(string $paymentId): array
    {
        try {
            $response = $this->httpClient
                ->request('get', sprintf('%s/%s/pixQrCode', self::PAYMENT_API_RESOURCE, $paymentId));

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $exception) {
            dd($exception);
        }
    }
}
