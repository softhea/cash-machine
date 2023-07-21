@extends('layouts.layout')

@section('content')
  <h1>Create Bank Transfer Transaction</h1>

  <div id="error"></div>

  <div class="col-lg-8 px-0">
    <form>
      <div class="mb-3">
        <label for="transfer_date" class="form-label">Transfer Date</label>
        <input type="date" class="form-control" name="transfer_date" aria-describedby="transfer_date">
      </div>
      <div class="mb-3">
        <label for="customer_name" class="form-label">Customer Name</label>
        <input type="text" class="form-control" name="customer_name" aria-describedby="customer_name">
      </div>
      <div class="mb-3">
        <label for="account_number" class="form-label">Account Number</label>
        <input type="text" class="form-control" name="account_number" aria-describedby="account_number">
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
    $(document).ready(function() {
      $('form').submit(function(event) {
        event.preventDefault();

        const request = $(this).serialize();
        
        $.post({
          url: "{{ route('bank_transactions.create') }}",
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