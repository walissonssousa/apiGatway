<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Services\Payment\PaymentService;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPayment(CreatePaymentRequest $request)
    {
        $paymentData = $request->validated();

        $transaction = $this->paymentService->processPayment($paymentData);

        return response()->json($transaction);
    }
}
