<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\TransactionFactory;
use App\Http\Resources\TransactionResource;
use App\Models\CardTransaction;
use App\Requests\CardTransactionRequest;
use App\Services\CashMachine;
use Illuminate\Http\Request;

class CardTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResource
    {
        $cardTransactionRequest = new CardTransactionRequest($request->input());

        $transaction = TransactionFactory::make(
            CardTransaction::class, 
            $cardTransactionRequest
        );
        
        $cashTransaction = $cashMachine->store($transaction);

        return new TransactionResource($cashTransaction);
    }
}
