<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    
    public function testCreateCashTransaction(): void
    {
        $inputs = [
            1, 5, 10, 50, 50, 50, 100, 100, 100, 100,
        ];

        $response = $this->post('/cash-transactions', [
            'banknotes' => $inputs,
        ]);

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
            "source" => "Cash",
            "amount" => 566,
            "inputs" => $inputs,
        ]);
    }

    public function testCreateCardTransaction(): void
    {
        $request = [
            'amount' => 173,
            'credit_card' => '4234123412341234',
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
            "source" => "Credit Card",
            "amount" => $request['amount'],
            "inputs" => $request,
        ]);
    }
}
