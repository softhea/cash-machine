<?php
declare(strict_types=1);

namespace App\Requests;

abstract class AbstractTransactionRequest
{
    protected int $amount;
    protected array $inputs;

    public function __construct(?array $request = null)
    {
        $this->amount = isset($request['amount']) ? (int)$request['amount'] : 0;
        $this->inputs = (array)$request;
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
