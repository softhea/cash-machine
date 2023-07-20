<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\MoneySources\TransactionFactory;
use App\Http\Resources\TransactionResource;
use App\MoneySources\CashTransaction;
use App\Requests\CashTransactionRequest;
use App\Services\CashMachine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResource|JsonResponse
    {
        $cashTransactionRequest = new CashTransactionRequest($request->input());

        $transaction = TransactionFactory::make(
            CashTransaction::class, 
            $cashTransactionRequest
        );

        try {
            $cashTransaction = $cashMachine->store($transaction);
        } catch (Exception $exception) {
            return new JsonResponse(
                [
                    'error' => $exception->getMessage(),
                ], 
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new TransactionResource($cashTransaction);
    }
}
