<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\TransactionFactory;
use App\Http\Resources\TransactionResource;
use App\Models\BankTransaction;
use App\Requests\BankTransactionRequest;
use App\Services\CashMachine;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResource
    {
        $bankTransactionRequest = new BankTransactionRequest($request->input());

        $transaction = TransactionFactory::make(
            BankTransaction::class, 
            $bankTransactionRequest
        );

        $cashTransaction = $cashMachine->store($transaction);

        return new TransactionResource($cashTransaction);
    }
}
