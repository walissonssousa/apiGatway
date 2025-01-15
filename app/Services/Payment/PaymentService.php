<?php

namespace App\Services\Payment;


use App\Repositories\PaymentRepository;
use App\Factories\PaymentGatewayFactory;


class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function processPayment(array $paymentData)
    {
        $gateway = PaymentGatewayFactory::create($paymentData['gateway']);

        $response = $gateway->charge($paymentData);

        if ($response->status === 'success') {
            $transaction = $this->paymentRepository->createTransaction([
                'amount' => $paymentData['amount'],
                'status' => 'paid',
                'gateway_transaction_id' => $response->transaction_id,
            ]);

            return $transaction;
        }

        $transaction = $this->paymentRepository->createTransaction([
            'amount' => $paymentData['amount'],
            'status' => 'failed',
        ]);

        return $transaction;
    }
}
