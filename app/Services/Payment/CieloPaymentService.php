<?php

namespace App\Services\Payment;

class CieloPaymentService
{
    public function charge(array $paymentData)
    {
        $response = $this->makeCieloRequest($paymentData);

        return $response;
    }

    protected function makeCieloRequest(array $paymentData)
    {
        return (object) [
            'status' => 'success',
            'transaction_id' => '1234567890',
        ];
    }
}
