<?php

use App\Http\Controllers\CashTransactionController;
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