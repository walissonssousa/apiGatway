<?php

namespace App\Repositories;

use App\Models\Transaction;

class PaymentRepository
{
    public function createTransaction(array $data)
    {
        return Transaction::create($data);
    }

    public function getTransactionById(int $id)
    {
        return Transaction::find($id);
    }
}
