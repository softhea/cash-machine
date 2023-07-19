<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CashTransactionController extends Controller
{
    public function create()
    {

    }

    public function store(Request $request)
    {
        // dd($request->input());

        return new JsonResponse();
    }
}
