<?php

namespace App\Services;

class TransactionService
{
    public function findTransaction(int $transactionId): array
    {
        return [
            'transactionId' => $transactionId,
            'amount' => 25,
        ];
    }
}
