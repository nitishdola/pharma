@extends('layouts.user')
@section('title') Add a Company @stop
@section('page_title') Add a Company @stop
@section('breadcumb') 
<li>
	<i class="fa fa-home"></i>
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>

<li>
	Add a Company
</li>

@stop
@section('content')
<div class="col-lg-12">
	<div class="widget-content">
		{!! Form::open(array('route' => 'company.store', 'id' => 'company.store', 'class' => 'form-horizontal row-border')) !!}
			@include('master.companies._form')
		{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
		{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
		{!!form::close()!!}
	</div>
</div>
@stop