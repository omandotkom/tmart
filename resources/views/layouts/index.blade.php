<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>T-MART</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <link href="{{url('shop/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="{{url('shop/css/shop-homepage.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  @include('layouts.navbar')

  <!-- Page Content -->
  @switch($content)
    @case('products')
    @include('layouts.products')
    @break
    @case('cart')
    @include('layouts.cart')
    @break
    @case('orderlist')
    @include('layouts.orderlist')
    @break
    @case('checkout')
    @include('layouts.checkout')
    @break
    @case('addproduct')
    @include('layouts.product')
    @break
    @case('payment')
    @include('layouts.payment')
    @break
    @default
    @include('layouts.products')
    @break
  @endswitch
  <!-- /.container -->

  <!-- Footer -->
  
  <!-- Bootstrap core JavaScript -->
  <script src="{{url('shop/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('shop/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
