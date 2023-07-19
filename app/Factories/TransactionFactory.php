<?php
declare(strict_types=1);

namespace App\Factories;

use App\Interfaces\Transaction;
use App\Interfaces\TransactionRequest;

class TransactionFactory
{
    public static function make(string $className, TransactionRequest $request): Transaction
    {
        /** @var Transaction $transaction */
        $transaction = new $className;
        $transaction->processRequest($request);

        return $transaction;
    }
}
