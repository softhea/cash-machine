<?php
declare(strict_types=1);

namespace App\Requests;

use App\Interfaces\TransactionRequest;

class CashTransactionRequest extends AbstractTransactionRequest implements TransactionRequest
{
    public function __construct(?array $request = null) 
    {
        $bancknotes = $request['banknotes'] ?? [];
        foreach ($bancknotes as $bancknote) {
            $this->inputs[] = (int)$bancknote;
            $this->amount += (int)$bancknote;
        }
    }
}
