<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'gateway' => 'required|in:cielo',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string',
        ];
    }
}
