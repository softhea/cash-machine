@extends('layouts.layout')

@section('content')
  <h1>Cash Machine</h1>

  <div class="col-lg-8 px-0">
    <p><a href="{{ route('cash_transactions.create')}}">Create Cash Transaction</a></p>
    <p><a href="{{ route('card_transactions.create')}}">Create Credit Card Transaction</a></p>
    <p><a href="{{ route('bank_transactions.create')}}">Create Bank Transfer Transaction</a></p>
  </div>
@endsection