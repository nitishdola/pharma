@extends('layouts.user')
@section('page_title') Receive Stock @stop

@section('content')
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-content">
			<div class="col-md-6 col-md-offset-3">
				<div class="alert alert-success }}">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                </div>

                <a href="{{ route('stock.receive) }}" class="btn btn-success"> Receive More Products </a>

                <a href="{{ route('product.index) }}" class="btn btn-info"> View All Products </a>

                <a href="{{ route('dashboard) }}" class="btn btn-warning"> Back to Dashboard </a>

			</div>
		</div>
	</div>
</div>
@stop
