<?php
declare(strict_types=1);

namespace App\Services;

use App\MoneySources\Transaction;
use App\Models\Transaction as TransactionModel;
use Exception;

class CashMachine
{
    public const LIMIT = 20000;

    private Transaction $transaction;
    private TransactionModel $newTransaction;

    /**
     * @throws Exception
     */
    public function store(Transaction $transaction): TransactionModel
    {
        $this->transaction = $transaction;

        $this->validate();
        $this->persist();

        return $this->newTransaction;
    }

    /**
     * @throws Exception
     */
    private function validate(): void
    {
        $this->transaction->validate();
        $this->validateAmount();
    }

    /**
     * @throws Exception
     */
    private function validateAmount(): void
    {
        $currentAmount = (int)TransactionModel::query()->sum('amount');
        if ($currentAmount + $this->transaction->amount() > self::LIMIT) {
            throw new Exception(
                'Maximum Amount for Total Processing would be reached!'
            );
        }
    }

    private function persist(): void
    {
        $this->newTransaction = TransactionModel::query()->create([
            'source_id' => $this->transaction->sourceId(),
            'source_name' => $this->transaction->sourceName(),
            'is_cache' => $this->transaction->isCash(),
            'amount' => $this->transaction->amount(),
            'inputs' => $this->transaction->inputs(),
        ]);
    }
}
