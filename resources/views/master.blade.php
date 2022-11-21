<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>Data-X-Data Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon-icon.png')}}" />
    <link rel="icon" href="{{asset('assets/img/favicon-icon.png')}}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{asset('assets/vendor/pace/pace.css')}}">
    <script src="{{asset('assets/vendor/pace/pace.min.js')}}"></script>
    <!--vendors-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/jquery-scrollbar/jquery.scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/jquery-ui/jquery-ui.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/materialdesignicons/materialdesignicons.min.css')}}">
    <!--Bootstrap + dataxdata Admin CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dataxdata.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <!-- Additional library for page -->
</head>
<!--body with default sidebar pinned -->

<body class="sidebar-pinned">
    @if(auth()->user())
        @include('partial.sidebar')
        <main class="admin-main">

            <!--site header begins-->
            @include('partial.header')
            <!--site header ends -->
            <section class="admin-content">
                @yield('content')
            </section>
        </main>
        @yield('model')
    @else
        @yield('content')   
    @endif


    <script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/popper/popper.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/dataxdata.js')}}"></script>
    @yield('script')
    <!--page specific scripts for demo-->
</body>

</html>