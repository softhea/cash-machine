<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\TransactionRequest;

abstract class AbstractTransaction
{
    private int $amount = 0;
    private array $inputs = [];

    public function processRequest(TransactionRequest $request): void
    {
        $this->amount = $request->getAmount();
        $this->inputs = $request->getInputs();        
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
