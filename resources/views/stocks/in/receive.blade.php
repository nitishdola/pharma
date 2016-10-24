@extends('layouts.user')
@section('title') Receive Products @stop

@section('content')
<div class="col-md-8">
	<div class="widget box">
		<div class="widget-header">
			<h2>Receive Products</h2>
		</div>
		<div class="widget-content">
			{!! Form::open(array('route' => 'stock.store', 'id' => 'stock.store', 'class' => 'form-horizontal row-border')) !!}
				@include('stocks.in._form')
			{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
			{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
			{!!form::close()!!}
		</div>
	</div>
</div>
@stop

@section('page_script')
<script> 
$("#add_product").click(function(e) { alert('Hi');
	e.preventDefault();
	$pro = $('#product').clone();
	$('#morepros').html($pro);
});
</script>
@stop