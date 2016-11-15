@extends('layouts.user')
@section('page_title') Dispatch Stock @stop

@section('content')
<div class="col-md-12">
	<div class="widget box">
		<div class="widget-content">
			{!! Form::open(array('route' => 'stock_dispatch.store', 'id' => 'stock_dispatch.store', 'class' => 'form-horizontal row-border')) !!}
				@include('stocks.out._form')

				<div id="col-md-12">
					<a href="javascript:void(0)" class="btn btn-warning add_more_item">Add More Item <i class="fa fa-plus-square" aria-hidden="true"></i></a>
					<a href="javascript:void(0)" class="btn btn-danger remove_item" style="display:none">Remove <i class="fa fa-minus-square" aria-hidden="true"></i></a>
				</div>

			{!! Form::label('', '', array('class' => 'col-md-3 control-label')) !!}
			{!! Form:: submit('Submit', ['class' => 'btn btn-success']) !!}
			{!!form::close()!!}
		</div>
	</div>
</div>
@stop


@section('page_script')
<script>

$('.datepicker-years').Zebra_DatePicker({
  view: 'years'
});

//load_sections();
var item = 1;
$(".select2").select2();
$('.add_more_item').click(function(e) {
	$latest_tr 	= $('#stockout_table tr:last');
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
	$clone.find('.mrp').val('');
	$clone.find('.unit_cost').val('');
	$clone.find('.flat_rate').val('');
	$clone.find('.free').val('');
	$clone.find('.batch_number').val('');
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


$(".product_id").on("change", function() { console.log('Change');
	var url 	= '';
	var data	= '';
	var $this = $(this); //console.log($this.html());

	$latest_tr 	= $this.closest('tr');

	var product_id = $this.val();

	if(product_id != '' || product_id != 0) {
		$.blockUI();
		url 	+= '{{ route("rest.get_product_info") }}';
		data 	+= '&product_id='+product_id;
		$.ajax({
			data : data,
			url  : url,
			type : 'get',
			dataType : 'json',

			error : function(resp) {
				console.log(resp);
				$.unblockUI();
			},
			success : function(resp) {
				$.unblockUI();
				//$latest_tr 	= $('#stockout_table tr:last');

				
				$latest_tr.find('.mrp').val(resp.mrp);
				$latest_tr.find('.unit_cost').val(resp.trade);
			}
		});
	}
});

$(".quanity").on("keyup", function() { 
	var $this = $(this);
	var quanity = $this.val();
	$latest_tr 	= $this.closest('tr');
	var unit_cost = $latest_tr.find('.unit_cost').val();
	$latest_tr.find('.total_cost').val(quanity*unit_cost);
});

$(".flat_rate").on("keyup", function() { 
	var $this = $(this);
	var flat_rate = $this.val(); 
	$latest_tr 	= $this.closest('tr');
	var quantity = $latest_tr.find('.quanity').val(); var rate_ttl = (flat_rate*quantity);
	$latest_tr.find('.total_cost').val(rate_ttl);
});

</script>
@stop
