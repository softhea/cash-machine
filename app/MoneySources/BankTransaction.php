<?php
declare(strict_types=1);

namespace App\MoneySources;

class BankTransaction extends AbstractTransaction implements Transaction
{
    public function sourceId(): int
    {
        return 3;
    }

    public function sourceName(): string
    {
        return 'Bank Transfer';
    }

    protected function validationRules(): array
    {
        return [
            'amount' => 'required|integer|min:1',
            'account_number' => 'required|alpha_num|size:6',
            'transfer_date' => 'required|date|after_or_equal:today',
            'customer_name' => 'required',
        ];
    }
}
