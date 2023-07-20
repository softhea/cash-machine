<?php
declare(strict_types=1);

namespace App\MoneySources;

use App\Requests\TransactionRequest;

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
