<?php
declare(strict_types=1);

namespace App\Interfaces;

interface TransactionRequest
{
    public function getInputs(): array;

    public function getAmount(): int;
}
