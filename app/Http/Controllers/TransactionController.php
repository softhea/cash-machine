<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show(Transaction $transaction): TransactionResource
    {
        return new TransactionResource($transaction);
    }
}
