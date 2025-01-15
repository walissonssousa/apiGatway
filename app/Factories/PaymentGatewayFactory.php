<?php

namespace App\Factories;

use App\Services\Payment\CieloPaymentService;

class PaymentGatewayFactory
{
    public static function create(string $gateway)
    {
        switch ($gateway) {
            case 'cielo':
                return new CieloPaymentService();
            // Adicione mais gateways aqui no futuro, como Stripe, PagSeguro etc.
            default:
                throw new \Exception("Gateway não suportado: $gateway");
        }
    }
}
