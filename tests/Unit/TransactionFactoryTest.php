<?php

namespace Tests\Unit;

use App\Factories\TransactionFactory;
use App\Models\CashTransaction;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    public function testMakeCashTransaction(): void
    {
        $transaction = TransactionFactory::make(CashTransaction::class);

        $this->assertInstanceOf(CashTransaction::class, $transaction);
    }
}
