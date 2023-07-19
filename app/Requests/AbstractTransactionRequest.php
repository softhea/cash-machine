<?php
declare(strict_types=1);

namespace App\Requests;

abstract class AbstractTransactionRequest
{
    protected int $amount = 0;
    protected array $inputs = [];

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function setInputs(array $inputs): void
    {
        $this->inputs = $inputs;
    }
}
