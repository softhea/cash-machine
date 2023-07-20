<?php
declare(strict_types=1);

namespace App\MoneySources;

use App\Requests\TransactionRequest;

interface Transaction
{
    public function sourceId(): int;
    public function sourceName(): string;
    public function isCash(): bool;
    
    public function processRequest(TransactionRequest $request): void;

    public function validate(): void;
    public function amount(): int;
    public function inputs(): array;
}
