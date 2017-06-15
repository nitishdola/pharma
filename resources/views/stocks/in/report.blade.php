@extends('layouts.user')
@section('page_title') Receive Stock Report @stop

@section('content')
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-content">
		
			{!! Form::open(array('route' => 'stock.report', 'id' => 'stock.report', 'class' => 'form-horizontal row-border', 'method' => 'GET')) !!}
			<div class="row">
				<div class="form-group">
				  {!! Form::label('receive_date_from', 'Date From', array('class' => 'col-md-2 control-label')) !!}
				  <div class="col-md-3">
				    {!! Form::text('receive_date_from', null, ['class' => 'datepicker form-control col-md-6', 'id' => 'receive_date_from', 'placeholder' => 'All',  'autocomplete' => 'off',]) !!}
				  </div>
			
				  {!! Form::label('receive_date_to', 'Date To', array('class' => 'col-md-2 control-label')) !!}
				  <div class="col-md-3">
				    {!! Form::text('receive_date_to', null, ['class' => 'datepicker form-control col-md-6', 'id' => 'receive_date_to', 'placeholder' => 'All',  'autocomplete' => 'off',]) !!}
				  </div>
				</div>
			</div>

			<div class="row">
				<div class="form-group">
				  {!! Form::label('receipt_number', '', array('class' => 'col-md-2 control-label')) !!}
				  <div class="col-md-3">
				    {!! Form::text('receipt_number', null, ['class' => 'form-control col-md-6', 'id' => 'receipt_number', 'placeholder' => 'All',  'autocomplete' => 'off',]) !!}
				  </div>
				 
				  {!! Form::label('party_name', '', array('class' => 'col-md-2 control-label')) !!}
				  <div class="col-md-3">
				    {!! Form::text('party_name', null, ['class' => 'form-control col-md-6', 'id' => 'party_name', 'placeholder' => 'All',  'autocomplete' => 'off',]) !!}
				  </div>
				</div>

			</div>


			<div class="row">
				<div class="form-group">
				  {!! Form::label('party_bill_number', '', array('class' => 'col-md-2 control-label')) !!}
				  <div class="col-md-3">
				    {!! Form::text('party_bill_number', null, ['class' => 'form-control col-md-6', 'id' => 'party_bill_number', 'placeholder' => 'All',  'autocomplete' => 'off',]) !!}
				  </div>
				 
				  {!! Form::label('party_bill_date', '', array('class' => 'col-md-2 control-label')) !!}
				  <div class="col-md-3">
				    {!! Form::text('party_bill_date', null, ['class' => 'datepicker form-control col-md-6', 'id' => 'party_bill_date', 'placeholder' => 'All',  'autocomplete' => 'off',]) !!}
				  </div>
				</div>

			</div>

			<div class="row">
				{!! Form::label('', '', array('class' => 'col-md-2 control-label')) !!}
				{!! Form:: submit('Search', ['class' => 'btn btn-success']) !!}
				{!!form::close()!!}
			</div>
			<div  style="margin:10px 0 20px 0"></div>
			@if(count($results))
			<?php $count = 1; ?>
			<a href="{{ route('stock_in.excel') }}" class="btn btn-info">Download Data as Excel</a>
			<div  style="margin:10px 0 20px 0"></div>
			
			<div class="col-md-12">
				<table class="table table-striped table-bordered table-advance table-hover">
				    <thead>
				        <tr>
				            <th>#</th>
				            <th class="hidden-xs">Receipt Number</th>
				            <th> Receive Date </th>
				            <th> Party Name </th>
				            <th> Party Address </th>
				            <th> Party DL </th>
				            <th> View </th>
				        </tr>
				    </thead>
				    <tbody>
				    @foreach($results as $k => $v)
				        <tr>
				            <td> {{ (($results->currentPage() - 1 ) * $results->perPage() ) + $count + $k }} </td>
				            <td class="hidden-xs"> {{ $v->receipt_number }} </td>
				            <td> {{ date('d/m/Y', strtotime($v->receive_date)) }} </td>
				            <td class="hidden-xs"> {{ ucfirst($v->party_name) }} </td>
				            <td> {{ ucwords($v->party_address) }} </td>
				            <td class="hidden-xs"> {{ $v->party_dl }} </td>
				            <td> <a href="{{ route('stock.receipt', $v->id) }}" class="btn btn-info">View and Print</a> </td>
				        </tr>
				        @endforeach
				    </tbody>
				</table>
				<div class="pagination">
				{!! $results->render() !!}
				</div>

				@else
			    	<div class="alert alert-danger alert-dismissable alert-red">
	                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
	                  No Items Found !
	                </div>
			    @endif
			</div>
		</div>
	</div>
</div>
@stop