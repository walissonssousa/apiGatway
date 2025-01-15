<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class WebhookController extends Controller
{
    public function handlePaymentStatus(Request $request)
    {
        $secretKey = env('WEBHOOK_SECRET_KEY');
        $signature = $request->header('X-Signature');
        $payload = $request->getContent();

        if (!$this->isValidSignature($payload, $signature, $secretKey)) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        
        $data = json_decode($payload, true);
      
        return response()->json(['message' => 'Webhook received']);
    }

    private function isValidSignature($payload, $signature, $secretKey)
    {
        $calculatedSignature = hash_hmac('sha256', $payload, $secretKey);
        return hash_equals($calculatedSignature, $signature);
    }
}
