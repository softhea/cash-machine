<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Interfaces\TransactionRequest;

interface Transaction
{
    public function sourceId(): int;
    public function processRequest(TransactionRequest $request): void;
    public function validate(): void;
    public function amount(): int;
    public function inputs(): array;
}
