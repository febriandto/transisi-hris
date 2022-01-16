<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HRIS | PLEASE LOGIN</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="manifest" href="manifest.json">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
      <!-- IOS Support -->

    <link rel="apple-touch-icon" href="{{ asset('images/m_icon_72.png')}}">
    <link rel="apple-touch-icon" href="{{ asset('images/m_icon_96.png')}}">
    <link rel="apple-touch-icon" href="{{ asset('images/m_icon_128.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="{{ asset('images/icon.png') }}">
</head>
<style type="text/css">
    .gagal_login { text-align: center; color: red; }
    .login_area {
      margin-top: 70px;
      padding: 30px; background-color: white;
    }
</style>
    <body>
        @yield('content')
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('js/animsition.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="6cd0a645f81fee4f8c5039f3-|49" defer=""></script>
    </body>
</html>
