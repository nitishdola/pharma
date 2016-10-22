@extends('layouts.user')
@section('title') View all Products @stop
@section('page_title') View all Products @stop
@section('breadcumb') 
<li>
	<i class="fa fa-home"></i>
	<a href="{{ route('dashboard') }}">Dashboard</a>
</li>

<li>
	View Products
</li>

@stop
@section('content')
<?php $count = 1; ?>
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-header">
			<h4><i class="icon-reorder"></i> Products List</h4>
		</div>
		<div class="widget-content">
			@if($products->count())
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Company</th>
						<th>Product Name</th>
						<th class="hidden-xs">Quantity</th>
						<th>MRP</th>
						<th>Trade</th>
						<th>Stock</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $k => $v)
					<tr>
						<td> {{ (($products->currentPage() - 1 ) * $products->perPage() ) + $count + $k }}</td>
						<td>{{ $v->company['name'] }}</td>
						<td>{{ $v->name }}</td>
						<td class="hidden-xs">{{ $v->quantity }}</td>
						<td>{{ $v->mrp }}</td>
						<td>{{ $v->trade }}</td>
						<td>{{ $v->stock_in_hand }}</td>
					</tr>
					
					@endforeach
				</tbody>
			</table>

			<div class="pagination">
				{!! $products->render() !!}
			</div>
			@else
				<h3> No Results Found ! </h3>
			@endif
		</div>
	</div>
	<!-- /Simple Table -->
</div>
@stop