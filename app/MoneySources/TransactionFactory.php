<?php
declare(strict_types=1);

namespace App\MoneySources;

use App\Requests\TransactionRequest;
use App\Services\TransactionService;

class TransactionFactory
{
    public static function make(string $className, TransactionRequest $request): Transaction
    {
        /** @var Transaction $transaction */
        $transaction = new $className;
        if (CashTransaction::class === $className) {
            $transaction->setTransactionService(new TransactionService());
        }
        $transaction->processRequest($request);

        return $transaction;
    }
}
