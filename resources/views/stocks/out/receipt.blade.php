@extends('layouts.user')
@section('page_title') Invoice : {{ $info->receipt_number }}@stop
@section('pageTitle') Invoice : {{ $info->receipt_number }}  @stop
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
				<div class="col-xs-6 col-xs-offset-3">
					Invoice {{ $info->receipt_number }}
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

				<table class="table table-bordered table-condensed">
					<tr>
						<th width="30%"> Product Name </th>
						<th width="15%"> Bill Qty </th>
						<th> Free </th>
						<th> Total Qty </th>
						<th> Batch Number </th>
						<th width="20%"> Expiry Date </th>
						<th> MRP </th>
						<th> Flat Rate </th>
						<th width="8%"> Trade Price </th>
						<th> Total 	Amt. </th>
					</tr>
					@foreach($products as $k => $v)
					<tr>
					 	<td> {{ $v->product['name'] }} {{ $v->product['unit'] }}</td>
					 	<td> {{ $v->quanity }} </td>
					 	<td> {{ $v->free }} </td>
					 	<td> {{ $v->quanity+$v->free }} </td>
					 	<td> {{ $v->batch_number }} </td>
					 	<td> {{ date('d-m-Y', strtotime($v->expiry_date)) }} </td>
						<td> {{ $v->mrp }} </td>
					 	<td> {{ $v->flat_rate }} </td>
					 	<td> {{ $v->unit_cost }} </td>
					 	
					 	<td> {{ $v->total_cost }} </td>
					 </tr>
					@endforeach
					
					<tr class="info">
						<td colspan="7" align="right"><b>Total Amount</b> : </td>
						<td colspan="3"> Rs.  {{ $total }}</td>
					</tr>

					<tr>
						<td colspan="7" align="right"><b>A.Vate </b> : </td>
						<td colspan="3"> Rs.  {{ $vat }} @ {{ $info->avat }} %</td>
					</tr>

					<tr>
						<td colspan="7" align="right"></td>
						<td colspan="3"> Rs.  {{ $total+$vat }}</td>
					</tr>

					<tr>
						<td colspan="7" align="right"><b>Less Special </b> : </td>
						<td colspan="3"> Rs.  {{ $info->special_discount }}</td>
					</tr>

					<tr style="background:#D6D4D1">
						<td colspan="8" align="right"><b>Grand Total </b> : </td>
						<td colspan="2"> Rs.  {{ $grand_total }}</td>
					</tr>

					<tr>
						<td colspan="4" align="right"><b>Total Payable in text</b> : </td>
						<td colspan="6" style="text-align:right">{{ ucwords($total_in_text) }}</td>
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

						<td class="col-xs-4">
							TIN
						</td>
					</tr>

					<tr>
						<td>  {{ date('d/m/Y', strtotime($info->dispatch_date)) }} </td>
						<td>  {{ $info->receipt_number }}</td>
						<td>  &nbsp; </td>
					</tr>

					
				</table>
				<p style="padding:10px 0"> Ref. Challan Number .......................................... Date .......................</p>
			</div>
			<div class="col-xs-10"></div>
			<div class="col-xs-2"><input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="PRINT" /></div>
			
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
