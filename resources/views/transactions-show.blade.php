@extends('layouts.layout')

@section('content')
  <h1>Transaction</h1>

  <div class="col-lg-8 px-0">
    <table class="table">
      <tr>
        <th>ID</th>
        <td id="id">{{ $transaction->id }}</td>
      </tr>
      <tr>
        <th>Source</th>
        <td id="source">{{ $transaction->source_name }}</td>
      </tr>
      <tr>
        <th>Is Cache</th>
        <td id="is_cache">{{ $transaction->is_cache ? 'true' : 'false' }}</td>
      </tr>
      <tr>
        <th>Total</th>
        <td id="total">{{ $transaction->amount }}</td>
      </tr>
      <tr>
        <th>Inputs</th>
        <td><code><pre id="inputs">{{ json_encode($transaction->inputs, JSON_PRETTY_PRINT) }}</pre></code></td>
      </tr>
    </table>
  </div>
@endsection