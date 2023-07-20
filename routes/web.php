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
    return view('welcome');
});

Route::get('cash-transactions', [CashTransactionController::class, 'create']);
Route::post('cash-transactions', [CashTransactionController::class, 'store']);

Route::get('card-transactions', [CardTransactionController::class, 'create']);
Route::post('card-transactions', [CardTransactionController::class, 'store']);

Route::get('bank-transactions', [BankTransactionController::class, 'create']);
Route::post('bank-transactions', [BankTransactionController::class, 'store']);

Route::get('transactions/{transaction}', [TransactionController::class, 'show']);
