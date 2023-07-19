<?php
declare(strict_types=1);

namespace App\Factories;

use App\Interfaces\Transaction;

class TransactionFactory
{
    public static function make(string $className): Transaction
    {
        return new $className;
    }
}
