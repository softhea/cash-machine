<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Transaction;
use App\MoneySources\Transaction as TransactionInterface;

class TransactionService
{
    public function getTotalAmount(): int
    {
        return (int)Transaction::query()->sum('amount');
    }

    public function getTotalCashAmount(): int
    {
        return (int)Transaction::query()
            ->where('is_cache', true)
            ->sum('amount');
    }

    public function create(TransactionInterface $transaction): Transaction
    {
        return Transaction::query()->create([
            'source_id' => $transaction->sourceId(),
            'source_name' => $transaction->sourceName(),
            'is_cache' => $transaction->isCash(),
            'amount' => $transaction->amount(),
            'inputs' => $transaction->inputs(),
        ]);
    }
}
