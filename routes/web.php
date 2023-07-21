<?php

use App\Http\Controllers\BankTransactionController;
use App\Http\Controllers\CardTransactionController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('cash-transactions', [CashTransactionController::class, 'create'])
    ->name('cash_transactions.create');
Route::post('cash-transactions', [CashTransactionController::class, 'store'])
    ->name('cash_transactions.store');

Route::get('card-transactions', [CardTransactionController::class, 'create'])
    ->name('card_transactions.create');
Route::post('card-transactions', [CardTransactionController::class, 'store'])
    ->name('card_transactions.store');

Route::get('bank-transactions', [BankTransactionController::class, 'create'])
    ->name('bank_transactions.create');
Route::post('bank-transactions', [BankTransactionController::class, 'store'])
    ->name('bank_transactions.store');

Route::get('transactions/{transaction}', [TransactionController::class, 'show'])
    ->name('transactions.show');
