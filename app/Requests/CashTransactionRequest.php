<?php
declare(strict_types=1);

namespace App\Requests;

use App\Interfaces\TransactionRequest;

class CashTransactionRequest implements TransactionRequest
{
    private int $amount = 0;
    private array $inputs = [];

    public function __construct(?array $inputs = null) 
    {
        foreach ((array)$inputs as $bancknote) {
            $this->inputs[] = (int)$bancknote;
            $this->amount += (int)$bancknote;
        }
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getInputs(): array
    {
        return $this->inputs;
    }
}
