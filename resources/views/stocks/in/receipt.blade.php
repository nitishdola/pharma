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
	        font-family: "Segoe UI",Frutiger,"Frutiger Linotype","Dejavu Sans","Helvetica Neue",Arial,sans-serif
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
					
				</div>
				<table class="table table-bordered table-condensed">
					<tr>
						<td>
							Date 
						</td>

						<td>
							Receipt Number 
						</td>
						<td>
							From
						</td>
					</tr>

					<tr>
						<td>  12/3/2014 </td>
						<td>  PUR|RTL|9 </td>
						<td> Amiya Drug Agency
						     <br> barpeta assam
						</td>
					</tr>
				</table>

				<table class="table table-bordered">
					<tr>
						<th> Product Name </th>
						<th> Unit Cost </th>
						<th> Quantity </th>
						<th> Total Cost </th>
					</tr>
					<tr>
					 	<td> Nh sads 124ML </td>
					 	<td> 250.22</td>
					 	<td> 4 </td>
					 	<td> &#8377; 250.00 </td>
					 </tr>

					<tr>
						<td> Nh sads 124ML </td>
						<td> 250.22</td>
						<td> 4 </td>
						<td> &#8377; 250.00 </td>
					</tr>

					<tr>
					 	<td> Nh sads 124ML </td>
					 	<td> 250.22</td>
					 	<td> 4 </td>
					 	<td> &#8377; 250.00 </td>
					</tr>
					<tr>
						<td colspan="3" align="right"><b>Total </b> : </td>
						<td> &#8377; {{ $total }}</td>
					</tr>
					<tr>
						<td colspan="2" align="right"><b>Total Payable in text</b> : </td>
						<td colspan="2">{{ $total_in_text }}</td>
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
