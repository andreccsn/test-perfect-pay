<?php

namespace App\Application\Http\Controllers;

use App\Application\Http\Requests\PaymentRequest;
use App\Application\ValueObject\PaymentData;
use App\Infra\Transformers\PaymentResponseTransformer;
use App\UseCases\ProcessPaymentUseCase;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        return view('checkout.index');
    }

    /**
     * @param PaymentRequest $request
     * @param ProcessPaymentUseCase $processPaymentUseCase Handle
     * @return View
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function finish(
        PaymentRequest $request,
        ProcessPaymentUseCase $processPaymentUseCase,
        PaymentResponseTransformer $paymentResponseTransformer
    ): View {
        try {
            $paymentData = PaymentData::fromArray($request->input());
            $paymentResponse = $processPaymentUseCase->execute($paymentData);
            return view('checkout.success', $paymentResponseTransformer->transform($paymentResponse));
        } catch (\Exception $exception) {
            return view('checkout.error');
        }
    }
}
