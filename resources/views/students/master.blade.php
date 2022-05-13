<!doctype html>
<html lang="{{app()->getLocale()}}" dir = "{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">

<head>

    <meta charset="utf-8" /> 
    <title> @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{school_data() ? school_data()->logo : asset('images/logo.png')}}">

    <!-- jquery.vectormap css -->
    <link href="{{asset('dashboard/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet')}}"
        type="text/css" />
    
    <link rel="stylesheet" href="{{asset('dashboard/assets/libs/morris.js/morris.css')}}">

    <!-- DataTables -->
    <link href="{{asset('dashboard/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet')}}" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('dashboard/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{asset('dashboard/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- toastr -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('dashboard/assets/libs/toastr/build/toastr.min.css')}}"> --}}
    {{-- select2 --}}
    <link href="{{asset('dashboard/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

    
 
    @if(app()->getLocale() == 'ar')
        <!-- Bootstrap Css -->
        <link href="{{asset('dashboard/assets/css/bootstrap-rtl.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('dashboard/assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@600&display=swap');

            h1 , h2 , h3 , h4 , h5 , h6 , p , input , textarea , select , span , th , td , button , a , label , option , div
            {
                font-family: 'Noto Kufi Arabic', sans-serif !important;
            }
        </style>
    @else 
        <!-- Bootstrap Css -->
        <link href="{{asset('dashboard/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('dashboard/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@600&display=swap');

            @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@500&display=swap');
            h1 , h2 , h3 , h4 , h5 , h6 , p , input , textarea , select , span , th , td , button , a , label , option , div
            {
                /* font-family: 'Signika Negative', sans-serif; */
                font-family: 'Merriweather Sans', sans-serif !important;
            }
        </style>
    @endif

    <style>
        #sidebar-menu ul li a {
            font-size: 20px;
        }

        #sidebar-menu ul li ul.sub-menu li a {
            font-size: 15px;
        }

        .vertical-collpsed .vertical-menu #sidebar-menu > ul > li:hover > ul {
            width: 300px;
        }

        .vertical-collpsed .vertical-menu #sidebar-menu > ul > li:hover > a {
            width: 370px;
        }
    </style>

       <!-- Icons Css -->
       <link href="{{asset('dashboard/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
       @toastr_css

       @livewireStyles

       @stack('styles')
    
</head>

<body>
    
<!-- <body data-layout="horizontal" data-topbar="light"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- ========== Header ========== -->
   @include('students.includes.header')
   

   
    <div class="vertical-menu" style = "width: 300px;">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            @include('students.includes.sidebar')
        </div>
    </div>
    
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- breadcrums -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>

                 <!-- Alerts -->
                @include('students.includes.alerts')
                
                @yield('content')
            </div>
        </div>
    </div>


</div>
<!-- END layout-wrapper -->

@include('students.includes.rightbar')

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{asset('dashboard/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/node-waves/waves.min.js')}}"></script>


<!-- morris chart -->
<script src="{{asset('dashboard/assets/libs/morris.js/morris.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/raphael/raphael.min.js')}}"></script>

<!-- jquery.vectormap map -->
<script src="{{asset('dashboard/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

<!-- Required datatable js -->
<script src="{{asset('dashboard/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<!-- Responsive examples -->
<script src="{{asset('dashboard/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('dashboard/assets/js/pages/dashboard.init.js')}}"></script>

@include('app')
@jquery
@toastr_js
@toastr_render

<!-- Sweet Alerts js -->
<script src="{{asset('dashboard/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- toastr plugin -->
{{-- <script src="{{asset('dashboard/assets/libs/toastr/build/toastr.min.js')}}"></script> --}}
{{-- select2 --}}
<script src="{{asset('dashboard/assets/libs/select2/js/select2.min.js')}}"></script>



<!-- App js -->
{{-- <script src="{{asset('dashboard/assets/js/app.js')}}"></script> --}}


<script>
    $("#check_all").click(function(){
        var checked = $(this).is(':checked');

        $(".select_row").prop('checked', checked).change();
    })  

    $(".select_row").change(function(){
        var selected_rows = [];
        var i = 0;

        $('.select_row:checked').each(function () {
                selected_rows[i++] = $(this).val();
        });

        $("input[name='selected_rows']").val(selected_rows);
    });
</script>

{{-- <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
   
</script> --}}


@livewireScripts
{{-- <script src="{{asset('/livewire/livewire.js')}}"></script> --}}

@stack('scripts')


</body>

</html>