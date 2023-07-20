<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\MoneySources\TransactionFactory;
use App\Http\Resources\TransactionResource;
use App\MoneySources\BankTransaction;
use App\Requests\BankTransactionRequest;
use App\Services\CashMachine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResource|JsonResponse
    {
        $bankTransactionRequest = new BankTransactionRequest($request->input());

        $transaction = TransactionFactory::make(
            BankTransaction::class, 
            $bankTransactionRequest
        );

        try {
            $cashTransaction = $cashMachine->store($transaction);
        } catch (ValidationException $exception) {
            return new JsonResponse(
                [
                    'error' => json_decode($exception->getMessage()),
                ], 
                JsonResponse::HTTP_BAD_REQUEST
            );
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
