<?php

namespace Tests\Feature;

use App\Services\Payment\CieloPaymentService;

use Tests\TestCase;
use Mockery;

class PaymentGatewayTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreatPaymentCielo()
    {
        $mockedGateway = Mockery::mock([CieloPaymentService::class]);
        
        $mockedGateway->shouldReceive('charge')
                      ->once()
                      ->with([
                          'amount' => 1000,
                          'payment_method_id' => 'pm_test',
                      ])
                      ->andReturn((object) [
                          'status' => 'success',
                          'transaction_id' => '1234567890',
                      ]);

        $this->app->instance(CieloPaymentService::class, $mockedGateway);

        $data = [
            'amount' => 1000,
            'payment_method_id' => 'pm_test',
        ];

        $response = $mockedGateway->charge($data);
        
        $this->assertEquals('success', $response->status);
        $this->assertEquals('1234567890', $response->transaction_id);
    }
}
