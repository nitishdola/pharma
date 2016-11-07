<div class="col-md-12">
	<div class="form-group {{ $errors->has('receive_date') ? 'has-error' : ''}}">
	  {!! Form::label('receive_date', 'Stock Receive Date', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-3">
	    {!! Form::text('receive_date', date('Y-m-d'), ['class' => 'datepicker form-control col-md-6 required', 'id' => 'receive_date',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('receive_date', '<span class="help-inline">:message</span>') !!}
	</div>


	<div class="form-group {{ $errors->has('receipt_number') ? 'has-error' : ''}}">
	  {!! Form::label('receipt_number', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-5">
	    {!! Form::text('receipt_number', $receipt_number, ['class' => 'form-control col-md-6 required', 'readonly' => true, 'id' => 'receipt_number',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('receipt_number', '<span class="help-inline">:message</span>') !!}
	</div>

	<div class="form-group {{ $errors->has('party_name') ? 'has-error' : ''}}">
	  {!! Form::label('party_name', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-5">
	    {!! Form::text('party_name', null, ['class' => 'form-control col-md-6 required', 'id' => 'party_name',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('party_name', '<span class="help-inline">:message</span>') !!}
	</div>

	<div class="form-group {{ $errors->has('party_address') ? 'has-error' : ''}}">
	  {!! Form::label('party_address', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-6">
	    {!! Form::text('party_address', null, ['class' => 'form-control col-md-6 required', 'id' => 'party_address',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('party_address', '<span class="help-inline">:message</span>') !!}
	</div>

</div>

<div class="col-md-12">
<hr>
<h3>Products form </h3>

	<table class="table table-bordered" id="stockin_table">
	  <thead>
	      <tr>
	        <th>
	          Product 
	        </th>

	        <th>
	          Units Cost
	        </th>

	        <th>
	          Quantity
	        </th>

	        <th>
	          Total Cost
	        </th>

	      </tr>
	  </thead>

	  <tbody>
	  	<tbody>
	  		<tr>
	  			<td class="col-md-3">
	  				{!! Form::select('product_id[]', $products, null, ['class' => 'col-md-12 select2 required', 'id' => 'product_id',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('unit_cost[]', null, ['class' => 'unit_cost form-control col-md-6 required', 'id' => 'unit_cost', 'step' => '0.01',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('quanity[]', null, ['class' => 'quanity form-control col-md-6 required', 'id' => 'quanity',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  			</td>

	  			<td>
	  				{!! Form::text('total_cost[]', null, ['class' => 'total_cost form-control col-md-6 required', 'id' => 'total_cost',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  			</td>
	  		</tr>
	  	</tbody>
	  </tbody>
	</table>
</div>

