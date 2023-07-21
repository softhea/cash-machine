<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function show(Transaction $transaction): View
    {
        return view('transactions-show', compact('transaction'));
    }

    public function view(Transaction $transaction): TransactionResource
    {
        return new TransactionResource($transaction);
    }
}
