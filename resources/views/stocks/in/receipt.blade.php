@extends('layouts.user')
@section('page_title') Purchase Stock Bill @stop
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
<div class="col-xs-12">
	<div class="widget box">
		<div class="widget-content">

			<div class="col-xs-12" id="printableArea">
				<div class="col-md-6 col-md-offset-3">
					Invoice
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
							<br>Address : {{ $info->party_address }}
							<br>Party DL : {{ $info->party_dl }}
							<br>Party Bill Number and Date :  {{ $info->party_bill_number }} {{ date('d-m-Y', strtotime($info->party_bill_date)) }}
						</td>
					</tr>
				</table>

				<table class="table table-bordered">
					<tr>
						<th width="30%"> Product Name </th>
						<th width="15%"> Batch No </th>
						<th width="20%"> Expiry Date </th>
						<th> Unit Cost </th>
						<th> MRP </th>
						<th width="7%"> Qty </th>
						<th width="20%"> Total Cost </th>
					</tr>
					@foreach($products as $k => $v)
					<tr>
					 	<td> {{ $v->product['name'] }} {{ $v->product['unit'] }}</td>
					 	<td> {{ $v->batch_number }} </td>
					 	<td> {{ $v->expiry_date }} </td>
					 	<td> {{ $v->unit_cost }} </td>
						<td> {{ $v->mrp }} </td>
					 	<td> {{ $v->quanity }} </td>
					 	<td> Rs.  {{ $v->total_cost }} </td>
					 </tr>
					@endforeach
					
					<tr>
						<td colspan="6" align="right"><b>Total </b> : </td>
						<td> Rs.  {{ $total }}</td>
					</tr>
					<tr>
						<td colspan="1" align="right"><b>Total Payable in text</b> : </td>
						<td colspan="6">{{ ucwords($total_in_text) }}</td>
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
						<td class="col-md-4">
							TIN
						</td>
					</tr>

					<tr>
						<td>  {{ date('d/m/Y', strtotime($info->receive_date)) }} </td>
						<td>  {{ $info->receipt_number }}</td>
						<td>  &nbsp; </td>
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
