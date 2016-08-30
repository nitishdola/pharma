@extends('layouts.user')
@section('title') Add a Product @stop

@section('content')
<h2>Add a Product</h2>
<div class="col-lg-12">
	<div class="widget-content">
		{!! Form::open(array('route' => 'product.store', 'id' => 'product.store', 'class' => 'form-horizontal row-border')) !!}
			@include('master.products._form')
		{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
		{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
		{!!form::close()!!}
	</div>
</div>
@stop