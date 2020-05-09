<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WELCOME BOARD | PLEASE LOGIN</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/AdminLTE.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth_util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth_main.css') }}">
    <link rel="icon" href="{{ asset('images/icon.png') }}">
</head>
<style type="text/css">
    .gagal_login { text-align: center; color: red; }
    .login_area {
      margin-top: 70px;
      padding: 30px; background-color: white;
    }
</style>
    <body style="background: #f1f1f1;">
        @yield('content')
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/animsition.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="6cd0a645f81fee4f8c5039f3-|49" defer=""></script>
    </body>
</html>
