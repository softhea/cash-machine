<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Transaction;

class CardTransaction extends AbstractTransaction implements Transaction
{
    public function sourceId(): int
    {
        return 2;
    }

    public function sourceName(): string
    {
        return 'Credit Card';
    }

    public function validate(): void
    {

    }
}
