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

    public function __construct(private TransactionService $transactionService) {}

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
        if ($this->transactionService->getTotalAmount() + $this->transaction->amount() > self::LIMIT) {
            throw new Exception(
                'Maximum Amount for Total Processing would be reached!'
            );
        }
    }

    private function persist(): void
    {
        $this->newTransaction = $this->transactionService->create($this->transaction);
    }
}
