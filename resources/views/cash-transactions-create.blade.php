@extends('layouts.layout')

@section('content')
  <h1>Create Cash Transaction</h1>

  <div class="col-lg-8 px-0">
    <form>
      <label for="banknotes" class="form-label">Banknotes</label>

      <div class="mb-3">
        <div class="btn-group" role="group">
          @foreach ($banknotes as $banknote)
            <button type="button" class="btn btn-primary banknote" data-value="{{ $banknote }}">{{ $banknote }}</button>
          @endforeach
        </div>
      </div>

      <div id="error"></div>

      <div id="banknotes"></div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.btn_remove', function() {  
        $(this).closest('div.mb-3').remove();
      });

      $(document).on('click', '.banknote', function() { 
        const value = $(this).data('value');
        
        $('#banknotes').append(
          '<div class="mb-3 row align-items-start">' +
            '<div class="col">' +
              '<input type="text" class="form-control" name="banknotes[]" aria-describedby="banknotes" value="' + value + '">' +
            '</div>' +
            '<div class="col">' +
              '<button type="button" class="btn btn-danger btn_remove">Remove</button>' +
            '</div>' +
          '</div>'
        );
      });
  
      $('form').submit(function(event) {
        event.preventDefault();

        const request = $(this).serialize();
        
        $.post({
          url: "{{ route('cash_transactions.create') }}",
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