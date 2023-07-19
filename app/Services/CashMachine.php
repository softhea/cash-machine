<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Transaction;
use App\Models\Transaction as TransactionModel;

class CashMachine
{
    public function store(Transaction $transaction): TransactionModel
    {
        $newTransaction = TransactionModel::create([
            'source_id' => $transaction->sourceId(),
            'amount' => $transaction->amount(),
            'inputs' => $transaction->inputs(),
        ]);
        $newTransaction->source_name = $transaction->sourceName();

        return $newTransaction;
    }
}
