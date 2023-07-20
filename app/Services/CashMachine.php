<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Transaction;
use App\Models\Transaction as TransactionModel;

class CashMachine
{
    private Transaction $transaction;
    private TransactionModel $newTransaction;

    public function store(Transaction $transaction): TransactionModel
    {
        $this->transaction = $transaction;

        $this->validate();
        $this->persist();

        return $this->newTransaction;
    }

    private function validate(): void
    {
        $this->transaction->validate();
        $this->validateAmount();
    }

    private function validateAmount(): void
    {

    }

    private function persist(): void
    {
        $this->newTransaction = TransactionModel::create([
            'source_id' => $this->transaction->sourceId(),
            'source_name' => $this->transaction->sourceName(),
            'amount' => $this->transaction->amount(),
            'inputs' => $this->transaction->inputs(),
        ]);
    }
}
