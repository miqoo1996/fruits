<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fruits</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body class="goto-here">
@include('layouts.includes.nav')
@yield('content')
@include('layouts.includes.footer')


<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="{{asset('template/js/jquery.min.js')}}"></script>
<script src="{{asset('template/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('template/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('template/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('template/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('template/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('template/js/aos.js')}}"></script>
<script src="{{asset('template/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('template/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('template/js/scrollax.min.js')}}"></script>
<script src="{{asset('template/js/main.js')}}"></script>

@yield('bottom-scripts')

</body>
</html>
