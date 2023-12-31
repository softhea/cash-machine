<?php

namespace Tests\Unit;

use App\MoneySources\TransactionFactory;
use App\MoneySources\BankTransaction;
use App\MoneySources\CardTransaction;
use App\MoneySources\CashTransaction;
use App\Requests\BankTransactionRequest;
use App\Requests\CardTransactionRequest;
use App\Requests\CashTransactionRequest;
use PHPUnit\Framework\TestCase;

class TransactionFactoryTest extends TestCase
{
    public function testMakeCashTransaction(): void
    {
        $request = [
            'banknotes' => [
                '100', '50two', 'three',
            ],
        ];
        $cashTransactionRequest = new CashTransactionRequest($request);

        $transaction = TransactionFactory::make(
            CashTransaction::class, 
            $cashTransactionRequest
        );

        $this->assertInstanceOf(CashTransaction::class, $transaction);
        $this->assertSame(150, $transaction->amount());
        $this->assertEquals($request, $transaction->inputs());
    }

    public function testMakeCardTransaction(): void
    {
        $request = [
            'amount' => '123',
            'input1' => 'aaa',
            'input2' => 'bbb',
        ];
        $cardTransactionRequest = new CardTransactionRequest($request);

        $transaction = TransactionFactory::make(
            CardTransaction::class, 
            $cardTransactionRequest
        );

        $this->assertInstanceOf(CardTransaction::class, $transaction);
        $this->assertSame((int)$request['amount'], $transaction->amount());
        $this->assertEquals($request, $transaction->inputs());
    }

    public function testMakeBankTransaction(): void
    {
        $request = [
            'amount' => '123',
            'input1' => 'aaa',
            'input2' => 'bbb',
        ];
        $bankTransactionRequest = new BankTransactionRequest($request);

        $transaction = TransactionFactory::make(
            BankTransaction::class, 
            $bankTransactionRequest
        );

        $this->assertInstanceOf(BankTransaction::class, $transaction);
        $this->assertSame((int)$request['amount'], $transaction->amount());
        $this->assertEquals($request, $transaction->inputs());
    }
}
