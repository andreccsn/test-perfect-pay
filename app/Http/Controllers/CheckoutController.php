<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('checkout.index');
    }

    public function finish(PaymentRequest $request): View
    {
        // validar dados da request - OK

        // verificar se existe o cliente no banco
        // caso nao exista, cadastrar
        $customer = Customer::where('document', preg_replace(
            '/[^\d]/',
            '',
            $request->input('customer.document'))
        )->first();

        if (!$customer) {
            $customer = new Customer();
            $customer->first_name = 'John';
            $customer->last_name = 'Doe';
            $customer->document = '10159694612';
            $customer->document_type = 'cpf';
            $customer->save();
        }

        // gerar uma nova transação com status 'initialized' no banco,
        // contendo os dados enviados pela request
        $transaction = new Transaction();
        $transaction->payment_method = $request->input('payment_method');
        $transaction->amount = (int) preg_replace('/[^\d]/', '', $request->input('amount'));
        $transaction->due_date = \DateTime::createFromFormat('d/m/Y', $request->input('due_date'));
        $transaction->status = 'initialized';
        $transaction->customer_id = $customer->id;
        $transaction->save();

        $billingType =  match($transaction->payment_method) {
            'bank_slip' => 'BOLETO',
            'credit_card' => 'CREDIT_CARD',
            'pix' => 'PIX'
        };

        $paymentData = [
            'customer' => 'cus_000006600539',
            'billingType' => $billingType,
            'value' => $transaction->amount / 100,
            'dueDate' => $transaction->due_date->format('Y-m-d')
        ];

        $headers = ['access_token' => config('services.asaas.api_token')];
        $urlParams = ['baseUrl' => config('services.asaas.base_url')];

        // processar pagamento no gateway asass
        $paymentResponse = Http::withUrlParameters($urlParams)
            ->withHeaders($headers)
            ->post('{+baseUrl}/payments', $paymentData)
        ;

        $response = ['payment_method' => $transaction->payment_method];

        // verificar se pagamento foi realizado com sucesso
        // se SIM, atualizar transação no banco para 'confirmed'
        // se NÃO, atualizar transação no banco para 'failed'
        if ($paymentResponse->ok()) {
            if ($transaction->payment_method == 'bank_slip') {
                $response['bank_slip_file'] = $paymentResponse->json('bankSlipUrl');
            }

            // recupera dados do qr code
            if ($transaction->payment_method == 'pix') {
                $pixContent = Http::withUrlParameters([
                    'endpoint' => config('services.asaas.base_url'),
                    'id' => $paymentResponse->json('id')
                ])
                    ->withHeaders($headers)
                    ->get('{+endpoint}/payments/{id}/pixQrCode')
                ;

                if ($pixContent->ok()) {
                    $response['qr_code_image'] = $pixContent->json('encodedImage');
                    $response['qr_code_content'] = $pixContent->json('payload');
                }
            }
        }

        // em caso de sucesso, deverá retornar os dados pro cliente
        // para boleto bancário: link do boleto
        // para pix: dados do qr code

        return view('checkout.success', $response);
    }
}
