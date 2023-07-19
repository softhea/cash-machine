<?php

namespace Tests\Unit;

use App\Factories\TransactionFactory;
use App\Models\CashTransaction;
use App\Requests\CashTransactionRequest;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    public function testMakeCashTransaction(): void
    {
        $transaction = TransactionFactory::make(
            CashTransaction::class, 
            new CashTransactionRequest()
        );

        $this->assertInstanceOf(CashTransaction::class, $transaction);
    }
}
