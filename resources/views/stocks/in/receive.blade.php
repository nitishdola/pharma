@extends('layouts.user')
@section('page_title') Purchase Stock @stop

@section('content')
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-content">
			{!! Form::open(array('route' => 'stock.store', 'id' => 'stock.store', 'class' => 'form-horizontal row-border')) !!}
				@include('stocks.in._form1')

				<div id="col-md-12">
					<a href="javascript:void(0)" class="btn btn-warning add_more_item">Add More Product <i class="fa fa-plus-square" aria-hidden="true"></i></a>
					<a href="javascript:void(0)" class="btn btn-danger remove_item" style="display:none">Remove <i class="fa fa-minus-square" aria-hidden="true"></i></a>
				</div>

			{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
			{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
			{!!form::close()!!}
		</div>
	</div>
</div>
@stop

<!-- <script>
$('#quanity').change(function() {
	$('#total_cost').val( $('#unit_cost').val() * $('#quanity').val());
});
</script> -->

@section('page_script')
<script>

$('.datepicker-years').Zebra_DatePicker({
  view: 'years'
});

//load_sections();
var item = 1;
$(".select2").select2();
$('.add_more_item').click(function(e) {
	$latest_tr 	= $('#stockin_table tr:last');
  $('select.select2').select2('destroy');
	$clone 			= $latest_tr.clone(true, true);
	$latest_tr.after($clone);// console.log($clone.html());
	$('select.select2').select2();
	$('.datepicker-years').Zebra_DatePicker({
  		view: 'years'
	});
	$clone.find(':text').val('');
	$clone.find('.quanity').val('');
	$clone.find('.unit_cost').val('');
	$clone.find('.total_cost').val('');
	item++;
	show_hide_item(item);
});

$('.remove_item').click(function(e) {
	item--;
  $latest_tr.remove();
	e.preventDefault();
	show_hide_item(item);
});

function show_hide_item( item ) {
	if(item > 1) {
		$('.remove_item').show();
	}else{
		$('.remove_item').hide();
	}
}

//$('.item_measurement').change(function(e) {
$(".quanity").on("keyup", function() { 
	var $this = $(this);
	var quanity = $this.val();
	$latest_tr 	= $this.closest('tr');//$('#stockin_table tr:last');
	var unit_cost = $latest_tr.find('.unit_cost').val();
	//var $parent = $this.parents('.material_item');
	
	
	$latest_tr.find('.total_cost').val(quanity*unit_cost);
	
});
</script>
@stop
