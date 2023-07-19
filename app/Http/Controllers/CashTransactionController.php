<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Factories\TransactionFactory;
use App\Http\Resources\TransactionResourse;
use App\Models\CashTransaction;
use App\Requests\CashTransactionRequest;
use App\Services\CashMachine;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResourse
    {
        $inputs = $request->input('banknotes');

        $cashTransactionRequest = new CashTransactionRequest($inputs);

        $transaction = TransactionFactory::make(
            CashTransaction::class, 
            $cashTransactionRequest
        );
        $transaction->validate();

        $cashTransaction = $cashMachine->store($transaction);

        return new TransactionResourse($cashTransaction);
    }
}
