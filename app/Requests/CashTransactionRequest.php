<?php
declare(strict_types=1);

namespace App\Requests;

class CashTransactionRequest extends AbstractTransactionRequest implements TransactionRequest
{
    public function __construct(?array $request = null) 
    {
        parent::__construct($request);

        $bancknotes = isset($request['banknotes']) ? (array)$request['banknotes'] : [];
        foreach ($bancknotes as $bancknote) {
            $this->amount += (int)$bancknote;
        }
    }
}
