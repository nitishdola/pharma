@extends('layouts.user')
@section('title') Edit a Product @stop
@section('page_title') Edit a Product @stop
@section('breadcumb') 
<li>
	<i class="fa fa-home"></i>
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>

<li>
	Edit a Product
</li>

@stop
@section('content')
<div class="col-lg-7">
	<div class="widget-content">
		{!! Form::model($product, array('route' => ['product.update', $product->id], 'id' => 'product.update', 'class' => 'form-horizontal row-border')) !!}
			@include('master.products._form')
		{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
		{!! Form:: submit('Update', ['class' => 'btn btn-success']) !!}
		{!!form::close()!!}
	</div>
</div>
@stop