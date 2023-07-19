<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Transaction;
use App\Interfaces\TransactionRequest;

class CashTransaction implements Transaction
{
    public const LIMIT = 5;

    private int $amount = 0;
    private array $inputs = [];

    public function sourceId(): int
    {
        return 1;
    }

    public function processRequest(TransactionRequest $request): void
    {
        $this->amount = $request->getAmount();
        $this->inputs = $request->getInputs();        
    }

    public function validate(): void
    {

    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function inputs(): array
    {
        return $this->inputs;
    }
}
