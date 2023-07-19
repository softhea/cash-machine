<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Transaction;

class CashTransaction extends AbstractTransaction implements Transaction
{
    public const LIMIT = 5;

    public function sourceId(): int
    {
        return 1;
    }

    public function sourceName(): string
    {
        return 'Cash';
    }

    public function validate(): void
    {

    }
}
