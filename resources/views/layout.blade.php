<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'T-Shirt Banai')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    
    
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
    
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.4/css/uikit.min.css" />

    @include('include.header')
  </head>
  <body>
    
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    
    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.4/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.7.4/js/uikit-icons.min.js"></script>
  </body>
</html>