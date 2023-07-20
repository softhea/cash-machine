<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\MoneySources\TransactionFactory;
use App\Http\Resources\TransactionResource;
use App\MoneySources\CardTransaction;
use App\Requests\CardTransactionRequest;
use App\Services\CashMachine;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request, CashMachine $cashMachine): TransactionResource|JsonResponse
    {
        $cardTransactionRequest = new CardTransactionRequest($request->input());

        $transaction = TransactionFactory::make(
            CardTransaction::class, 
            $cardTransactionRequest
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
