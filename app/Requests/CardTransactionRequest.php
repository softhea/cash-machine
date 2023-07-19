<?php
declare(strict_types=1);

namespace App\Requests;

use App\Interfaces\TransactionRequest;

class CardTransactionRequest extends AbstractTransactionRequest implements TransactionRequest
{
    public function __construct(?array $request = null) 
    {        
        $this->amount = $request['amount'] ? (int)$request['amount'] : 0;
        $request['amount'] = $this->amount;
        $this->inputs = $request;
    }
}
