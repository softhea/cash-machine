<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function testCreateCashTransaction(): void
    {
        $response = $this->post('/cash-transactions', [
            'banknotes' => [
                1, 5, 10, 50, 50, 50, 100, 100, 100, 100, 100,
            ],
        ]);

        $response->assertStatus(200);
    }
}
