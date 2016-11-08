<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@if (trim($__env->yieldContent('pageTitle'))) @yield('pageTitle') @else Pharma Admin Dashboard @endif</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- MetisMenu CSS -->
    <link href="{{ asset('bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('plugins/zebra_datepicker/public/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('page_css')
</head>

<body>

    <div id="wrapper">

        @include('layouts.navigation')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">@yield('page_title')</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>

           <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {!! Session::get('message') !!}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        <!-- jQuery -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    
        <script type="text/javascript" src="{{ asset('plugins/zebra_datepicker/public/javascript/zebra_datepicker.js') }}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('dist/js/sb-admin-2.js') }}"></script>

        <script type="text/javascript" src="{{ asset('plugins/select2/select2.full.js') }}"></script>

        <script type="text/javascript" src="{{ asset('plugins/jquery.blockUI.js') }}"></script>
        
        <script>
        $(document).ready(function(){
            "use strict";
            $('.datepicker').Zebra_DatePicker();
            $('.select2').select2();
        });
        </script>
        @yield('page_script')
    </footer>
</body>
</html>