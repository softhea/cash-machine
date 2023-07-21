<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cash Machine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>   
    <style>
        :root {
            --bs-body-bg: var(--bs-gray-100);
        }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Cash Machine</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link @if (Route::is('cash_transactions.create')) active @endif" aria-current="page" href="{{ route('cash_transactions.create')}}">Create Cash Transaction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if (Route::is('card_transactions.create')) active @endif" href="{{ route('card_transactions.create')}}">Create Card Transaction</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @if (Route::is('bank_transactions.create')) active @endif" href="{{ route('bank_transactions.create')}}">Create Bank Transaction</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container my-5">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
    <script>
        function displayErrors(error) 
        {
          let message = '';

          if ('object' === typeof error) {
            $.each(error, function(key, value) {
              if ('object' === typeof value) {
                $.each(value, function(k, error) {
                  message += error + '<br>';
                });
              } else {
                message += value + '<br>';
              }
            });
          } else {
            message = error;
          }

          $('#error').html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
              message +
              '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>'
          );
        }
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>
    @yield('scripts')
  </body>
</html>