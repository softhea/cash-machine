<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Transaction;

class BankTransaction extends AbstractTransaction implements Transaction
{
    public function sourceId(): int
    {
        return 3;
    }

    public function sourceName(): string
    {
        return 'Bank Transfer';
    }

    public function validate(): void
    {

    }
}
