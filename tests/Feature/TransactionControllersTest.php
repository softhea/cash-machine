<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionControllersTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCreateCashTransaction(): void
    {
        $request = [
            'banknotes' => [
                1, 5, 10, 50, 50, 50, 100, 100, 100, 100,
            ],
        ];

        $response = $this->post('/cash-transactions', $request);

        $response->assertCreated();

        $content = json_decode($response->getContent(), true);
        
        $this->assertNotNull($content);
        $this->assertArrayHasKey('data', $content);

        $content = $content['data'];

        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('created_at', $content);

        unset($content['id']);
        unset($content['created_at']);

        $this->assertSame($content, [
            'source' => 'Cash',
            'is_cache' => true,
            'amount' => 566,
            'inputs' => $request,
        ]);
    }

    public function testCreateCardTransaction(): void
    {
        $request = [
            'amount' => 173,
            'card_number' => '4234123412341234',
            'expiration_date' => '11/2026',
            'cvv' => 123,
            'card_holder' => 'John Doe',
        ];

        $response = $this->post('/card-transactions', $request);

        $response->assertCreated();

        $content = json_decode($response->getContent(), true);

        $this->assertNotNull($content);
        $this->assertArrayHasKey('data', $content);

        $content = $content['data'];

        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('created_at', $content);

        unset($content['id']);
        unset($content['created_at']);

        $this->assertSame($content, [
            'source' => 'Credit Card',
            'is_cache' => false,
            'amount' => $request['amount'],
            'inputs' => $request,
        ]);
    }

    public function testCreateBankTransaction(): void
    {
        $request = [
            'amount' => 59,
            'account_number' => 'RO1234',
            'transfer_date' => '2023-08-12',
            'customer_name' => 'Jane Smith',
        ];

        $response = $this->post('/bank-transactions', $request);

        $response->assertCreated();

        $content = json_decode($response->getContent(), true);

        $this->assertNotNull($content);
        $this->assertArrayHasKey('data', $content);

        $content = $content['data'];

        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('created_at', $content);

        unset($content['id']);
        unset($content['created_at']);

        $this->assertSame($content, [
            'source' => 'Bank Transfer',
            'is_cache' => false,
            'amount' => $request['amount'],
            'inputs' => $request,
        ]);
    }

    public function testShowTransaction(): void
    {
        $transaction = [
            'source_id' => 1,
            'source_name' => 'Source Name',
            'is_cache' => false,
            'amount' => 50,
            'inputs' => [
                'key' => 'value',
            ],
        ];

        $newTransaction = Transaction::query()->create($transaction);

        $expectedTransaction = [
            'id' => $newTransaction->id,
            'source' => 'Source Name',
            'is_cache' => false,
            'amount' => 50,
            'inputs' => [
                'key' => 'value',
            ],
            'created_at' => $newTransaction->created_at->format('Y-m-d H:i:s'),
        ];

        $response = $this->get('/api/transactions/'.$newTransaction->id);

        $response->assertOk();

        $content = json_decode($response->getContent(), true);

        $this->assertNotNull($content);
        $this->assertArrayHasKey('data', $content);

        $content = $content['data'];

        $this->assertSame($expectedTransaction, $content );
    }
}
