@extends('layouts.layout')

@section('content')
  <h1>Create Credit Card Transaction</h1>

  <div id="error"></div>

  <div class="col-lg-8 px-0">
    <form>
      <div class="mb-3">
        <label for="card_number" class="form-label">Card Number</label>
        <input type="number" class="form-control" name="card_number" aria-describedby="card_number">
      </div>
      <div class="mb-3">
        <label for="expiration_date" class="form-label">Expiration Date</label>
        <input type="text" class="form-control" id="expiration_date" name="expiration_date" aria-describedby="expiration_date">
      </div>  
      <div class="mb-3">
        <label for="card_holder" class="form-label">Card Holder</label>
        <input type="text" class="form-control" name="card_holder" aria-describedby="card_holder">
      </div>
      <div class="mb-3">
        <label for="cvv" class="form-label">CVV</label>
        <input type="number" class="form-control" name="cvv" aria-describedby="cvv">
      </div>
      <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" class="form-control" name="amount" aria-describedby="amount">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    const expiration_date = document.getElementById('expiration_date');
    const datepicker = new Datepicker(expiration_date, {
      'format': 'mm/yyyy'
    });

    $(document).ready(function() {
      $('form').submit(function(event) {
        event.preventDefault();

        const request = $(this).serialize();
        
        $.post({
          url: "{{ route('card_transactions.create') }}",
          data: request,
          dataType: 'json',
          success: function (response) {
            let url = '{{ route("transactions.show", ":id") }}';
            url = url.replace(':id', response.data.id);
            window.location.replace(url);
          },
          error: function (response) {
            displayErrors(response.responseJSON.error);
          }
        });
      });
    });
  </script>
@endsection