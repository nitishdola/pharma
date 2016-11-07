@extends('layouts.user')
@section('page_title') Dispatch Products @stop

@section('content')
<div class="col-md-8">
	<div class="widget box">
		<div class="widget-content">
			{!! Form::open(array('route' => 'stock.store', 'id' => 'stock.store', 'class' => 'form-horizontal row-border')) !!}
				@include('stocks.out._form')
			{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
			{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
			{!!form::close()!!}
		</div>
	</div>
</div>
@stop

@section('page_script')
<script>

</script>
@stop
