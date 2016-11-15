@extends('layouts.user')
@section('page_title') Receive Stock @stop
@section('pageTitle') Receipt : {{ $info->receipt_number }}  @stop
@section('page_css')
<style>
	@media print {
	    #printableArea {
	        height: 100%;
	        width: 100%;
	        position: fixed;
	        top: 0;
	        left: 0;
	        margin: 0;
	        font-size: 11px;
	        line-height: 14px;
	    }
	}
</style>
@stop
@section('content')
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-content">

			<div class="col-xs-12" id="printableArea">
				<div class="col-md-6 col-md-offset-3">
					Cash/Bill
				</div>
				<table class="table table-bordered table-condensed">
					<tr>
						<td>
							SAMANNAY DRUG DISTRIBUTOR
							<br>Seujpur , Barpeta Road 781315
							<br>Barpeta (ASSAM)
							<br>DL. NO. BPT/13943/44
							<br>Bill No. SDD/16 
						</td>

						<td>
							Dr./Ms {{ $info->party_name }}
							<br>Address {{ $info->party_address }}
							<br>Party DL {{ $info->party_dl }}
						</td>
					</tr>
				</table>

				<table class="table table-bordered">
					<tr>
						<th> Product Name </th>
						<th> Batch Number </th>
						<th> Expiry Date </th>
						<th> Free </th>
						<th> Bill </th>
						<th> MRP </th>
						<th> Quantity </th>
						<th> Total Cost </th>
					</tr>
					@foreach($products as $k => $v)
					<tr>
					 	<td> {{ $v->product['name'] }} {{ $v->product['unit'] }}</td>
					 	<td> {{ $v->batch_number }} </td>
					 	<td> {{ $v->expiry_date }} </td>
					 	<td> {{ $v->free }} </td>
					 	<td> {{ $v->unit_cost }} </td>
					 	<td> {{ $v->product['mrp'] }} </td>
					 	<td> {{ $v->quanity }} </td>
					 	<td> &#8377; {{ $v->total_cost }} </td>
					 </tr>
					@endforeach
					
					<tr>
						<td colspan="7" align="right"><b>Total </b> : </td>
						<td> &#8377; {{ $total }}</td>
					</tr>

					<tr>
						<td colspan="7" align="right"><b>A.Vate </b> : </td>
						<td> {{ $info->avat }} %</td>
					</tr>

					<tr>
						<td colspan="7" align="right"><b>Less Special </b> : </td>
						<td> &#8377; {{ $info->special_discount }}</td>
					</tr>

					<tr>
						<td colspan="7" align="right"><b>Grand Total </b> : </td>
						<td> &#8377; {{ $grand_total }}</td>
					</tr>

					<tr>
						<td colspan="3" align="right"><b>Total Payable in text</b> : </td>
						<td colspan="5">{{ ucwords($total_in_text) }}</td>
					</tr>

				</table>

				<table class="table table-bordered table-condensed">
					<tr>
						<td>
							Date 
						</td>

						<td>
							Receipt Number 
						</td>
					</tr>

					<tr>
						<td>  {{ date('d/m/Y', strtotime($info->dispatch_date)) }} </td>
						<td>  {{ $info->receipt_number }}</td>
					</tr>
				</table>

			</div>
			<div class="col-md-10"></div>
			<div class="col-md-2"><input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="PRINT" /></div>
			
		</div>
	</div>
</div>
@stop

@section('page_script')
<script language="javascript">

function printDiv(printpage)
{
	var headstr = "<html><head><title>PPP</title></head><body>";
	var footstr = "</body>";
	var newstr = document.all.item(printpage).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	window.print();
	document.body.innerHTML = oldstr;
	return false;
}
</script>
@stop
