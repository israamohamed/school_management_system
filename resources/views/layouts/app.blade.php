<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>Login | Appzia - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('dashboard/assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('dashboard/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('dashboard/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('dashboard/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>
<body class="auth-body-bg">
    <div id="app">
      
        <main class="py-4">
            @yield('content')
        </main>
    </div>

     <!-- JAVASCRIPT -->
     <script src="{{asset('dashboard/assets/libs/jquery/jquery.min.js')}}"></script>
     <script src="{{asset('dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
     <script src="{{asset('dashboard/assets/libs/metismenu/metisMenu.min.js')}}"></script>
     <script src="{{asset('dashboard/assets/libs/simplebar/simplebar.min.js')}}"></script>
     <script src="{{asset('dashboard/assets/libs/node-waves/waves.min.js')}}"></script>

     <script src="{{asset('dashboard/assets/js/app.js"></script>
</body>
</html>
