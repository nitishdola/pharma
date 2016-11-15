@extends('layouts.user')
@section('page_title') All Stock Out @stop
@section('pageTitle') All Stock Out  @stop

@section('content')
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-content">

			<div class="col-xs-12" id="printableArea">
		        <div class="statbox widget box box-shadow">
		            <div class="widget-content">
		                <div class="title"><h3>Recent Stock Out/ Dispatch Bills</h3></div>
		                <div class="value"></div>
		                @if(count($stock_out_bills))
		                <?php $count = 1; ?>
		                <table width="100%" class="table datatable table-striped table-bordered table-hover" id="dataTables-example">
		                    <thead>
		                        <th>Sl No</th>
		                       	<th>Company </th>
		                        <th>Bill Date</th>
		                        <th>Receipt Number</th>
		                        <th>Party Name</th>
		                        <th>Party Address</th>
		                        <th>Party DL</th>
		                        <th>View Details/Print</th>
		                    </thead>

		                    <tbody>
		                        @foreach($stock_out_bills as $k => $v)
		                        <tr>
		                            <td> {{ (($stock_out_bills->currentPage() - 1 ) * $stock_out_bills->perPage() ) + $count + $k }} </td>
		                            <td> {{ $v->company['name'] }} </td>
		                            <td> {{ date('d-m-Y', strtotime($v->dispatch_date)) }} </td>
		                            <td> {{ $v->receipt_number }} </td>
		                            <td> {{ $v->party_name }} </td>
		                            <td> {{ $v->party_address }} </td>
		                            <td> {{ $v->party_dl }} </td>
		                            <td> 
		                                <a href="{{ route('stock.receipt', $v->id) }}">View/Print</a>
		                            </td>
		                        </tr>
		                        @endforeach
		                    </tbody>
		                </table>

		                <div class="pagination">
						{!! $stock_out_bills->render() !!}
						</div>
		                
		                @else
		                <div class="alert alert-warning">
		                  <strong>No Bills Found !</strong> 
		                </div>
		                @endif
		            </div>
		    	</div> <!-- /.col-md-3 -->

			</div>
			
			
		</div>
	</div>
</div>
@stop
