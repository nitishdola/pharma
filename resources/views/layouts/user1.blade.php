<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Dashboard | Pharma &amp;</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('plugins/zebra_datepicker/public/css/default.css') }}"> 
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="{{ asset('assets/css/fontawesome/font-awesome-ie7.min.css') }}">
	<![endif]-->

	<!--[if IE 8]>
		<link href="{{ asset('assets/css/ie8.css') }}" rel="stylesheet" type="text/css" />
	<![endif]-->

	@yield('page_css')

	<!--=== JavaScript ===-->


	<script type="text/javascript" src="{{ asset('assets/js/libs/jquery-1.10.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('plugins/select2/select2.min.js') }}"></script>

	<!-- App -->
	<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>

	<script type="text/javascript" src="{{ asset('plugins/zebra_datepicker/public/javascript/zebra_datepicker.js') }}"></script>
	<script>
	$(document).ready(function(){
		"use strict";
		$('.datepicker').Zebra_DatePicker();
		$('.select2').select2();
	});
	</script>
	@yield('page_script')
</head>

<body>

@include('layouts.header')
<div id="container">
@include('layouts.sidebar')
<div id="content">
	<div class="container">
		<!-- <div class="crumbs">
			<ul id="breadcrumbs" class="breadcrumb">
				@yield('breadcumb')
			</ul>
		</div> -->
		<!-- <div class="page-header">
			<div class="page-title">
				<h3>@yield('page_title')</h3>
			</div>
		</div> -->
		<div class="row row-bg">
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

