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
            "source" => "CashTransaction",
            "amount" => 566,
            "inputs" => $inputs,
        ]);
    }
}
