@extends('layouts.user')
@section('title') Add a Product @stop
<<<<<<< HEAD
@section('page_title') Add a Product @stop
@section('breadcumb') 
<li>
	<i class="fa fa-home"></i>
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>

<li>
	Add a Product
</li>

@stop
@section('content')
<div class="col-lg-7">
=======

@section('content')
<h2>Add a Product</h2>
<div class="col-lg-12">
>>>>>>> a6359495d6e02978b5722dc597581fdfd35df2c7
	<div class="widget-content">
		{!! Form::open(array('route' => 'product.store', 'id' => 'product.store', 'class' => 'form-horizontal row-border')) !!}
			@include('master.products._form')
		{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
		{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
		{!!form::close()!!}
	</div>
</div>
@stop