<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Blog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{ asset('assets/fontend/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontend/css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontend/css/ionicons.css') }}" rel="stylesheet">

     @stack('css')
</head>
<body>
    


  @include('layouts.frontend.partial.header')


   @yield('content')


  @include('layouts.frontend.partial.footer')




    <!-- SCIPTS -->

    <script src="{{ asset('assets/fontend/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/tether.min.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/fontend/js/scripts.js') }}"></script>

@stack('js')

</body>
</html>