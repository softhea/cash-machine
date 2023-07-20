<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\TransactionFactory;
use App\Http\Resources\TransactionResource;
use App\Models\CashTransaction;
use App\Requests\CashTransactionRequest;
use App\Services\CashMachine;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResource
    {
        $cashTransactionRequest = new CashTransactionRequest($request->input());

        $transaction = TransactionFactory::make(
            CashTransaction::class, 
            $cashTransactionRequest
        );

        $cashTransaction = $cashMachine->store($transaction);

        return new TransactionResource($cashTransaction);
    }
}
