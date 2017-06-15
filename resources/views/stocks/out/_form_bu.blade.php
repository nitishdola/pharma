<div class="col-md-12">
	

	<div class="form-group {{ $errors->has('dispatch_date') ? 'has-error' : ''}}">
	  {!! Form::label('dispatch_date', 'Stock Sell Date', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-3">
	    {!! Form::text('dispatch_date', date('Y-m-d'), ['class' => 'datepicker form-control col-md-6 required', 'id' => 'dispatch_date',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('dispatch_date', '<span class="help-inline">:message</span>') !!}
	</div>


	<div class="form-group {{ $errors->has('receipt_number') ? 'has-error' : ''}}">
	  {!! Form::label('receipt_number', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-5">
	    {!! Form::text('receipt_number', $receipt_number, ['class' => 'form-control col-md-6 required', 'id' => 'receipt_number',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('receipt_number', '<span class="help-inline">:message</span>') !!}
	</div>

	<div class="form-group {{ $errors->has('party_name') ? 'has-error' : ''}}">
	  {!! Form::label('party_name and DL', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-3">
	    {!! Form::text('party_name', null, ['class' => 'form-control col-md-6 required', 'id' => 'party_name',  'autocomplete' => 'off', 'required' => 'true', 'placeholder' => 'Party Name']) !!}
	  </div>

	  <div class="col-md-3">
	    {!! Form::text('party_dl', null, ['class' => 'form-control col-md-6', 'id' => 'party_dl',  'autocomplete' => 'off', 'placeholder' => 'Party DL']) !!}
	  </div>

	  {!! $errors->first('party_name', '<span class="help-inline">:message</span>') !!}
	</div>

	<div class="form-group {{ $errors->has('party_address') ? 'has-error' : ''}}">
	  {!! Form::label('party_address', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-6">
	    {!! Form::text('party_address', null, ['class' => 'form-control col-md-6 required', 'id' => 'party_address', 'placeholder' => 'Party Address',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('party_address', '<span class="help-inline">:message</span>') !!}
	</div>

	<div class="form-group {{ $errors->has('avat') ? 'has-error' : ''}}">
	  {!! Form::label('avat', 'AVAT and Special Discount', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-2">
	    {!! Form::number('avat', null, ['class' => 'form-control col-md-6 required', 'id' => 'avat',  'autocomplete' => 'off', 'step' => '0.01', 'required' => 'true', 'placeholder' => 'AVAT']) !!}
	  </div>
	  <div class="col-md-1">%</div>
	  <div class="col-md-3">
	    {!! Form::number('special_discount ', null, ['class' => 'form-control col-md-6', 'id' => 'special_discount ', 'step' => '0.01',  'autocomplete' => 'off', 'placeholder' => 'Special Discount in Rupees']) !!}
	  </div>

	  {!! $errors->first('party_name', '<span class="help-inline">:message</span>') !!}
	</div>

</div>

<div class="col-md-12">
<hr>
	<table class="table table-bordered table-condensed" id="stockout_table">
	  <thead>
	      <tr>
	        <th>
	          Product 
	        </th>

	        <th>
	          Bill Quantity
	        </th>

	        <th>Free </th>

	        <th>Total Quantity </th>

	        <th>
	        	Expiry Date
	        </th>

	        <th>Batch Number </th>
	        
	        
	        <th>MRP </th>
	        <th>
	          Trade Rate
	        </th>
	        <th>Flat Rate </th>
	        

	        <th>
	          Total Amt.
	        </th>

	      </tr>
	  </thead>

	  <tbody>
	  	<tbody>
	  		@for( $i=0; $i <4; $i++)
	  		<tr>
	  			<td class="col-md-2">
	  				{!! Form::select('product_id[]', $products, null, ['class' => 'product_id col-md-12 select2 required', 'id' => 'product_id',   'autocomplete' => 'off', ]) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('quanity[]', null, ['class' => 'quanity form-control col-md-6 required', 'id' => 'quanity',  'autocomplete' => 'off',  'placeholder' => 'Quantity']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('free[]', 0, ['class' => 'free form-control col-md-6 required', 'id' => 'free',  'autocomplete' => 'off', 'placeholder' => 'Free']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('total_qty[]', 0, ['class' => 'total_qty form-control col-md-6 required', 'id' => 'total',  'autocomplete' => 'off', 'placeholder' => 'Free']) !!}
	  			</td>

	  			<td class="col-md-2">
	  				{!! Form::text('expiry_date[]', null, ['class' => 'datepicker-years form-control col-md-6 required', 'id' => 'expiry_date',  'autocomplete' => 'off',  'placeholder' => 'Expiry Date']) !!}
	  			</td>

	  			<td>
	  				{!! Form::text('batch_number[]', null, ['class' => 'batch_number form-control col-md-6 required', 'id' => 'batch_number',  'autocomplete' => 'off',  'placeholder' => 'Batch Number']) !!}
	  			</td>

	  		

	  			<td>
	  				{!! Form::number('mrp[]', null, ['class' => 'mrp form-control col-md-6 required', 'id' => 'mrp', 'step' => '0.01',  'autocomplete' => 'off',  'placeholder' => 'MRP']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('unit_cost[]', null, ['class' => 'unit_cost form-control col-md-6 required', 'id' => 'unit_cost', 'step' => '0.01',  'autocomplete' => 'off',  'placeholder' => 'Unit Cost']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('flat_rate[]', null, ['class' => 'flat_rate form-control col-md-6 required', 'id' => 'free',  'autocomplete' => 'off','placeholder' => 'Flat rate']) !!}
	  			</td>

	  			
	  			<td>
	  				{!! Form::text('total_cost[]', null, ['class' => 'total_cost form-control col-md-6 required', 'id' => 'total_cost',  'autocomplete' => 'off',  'placeholder' => 'Total Cost']) !!}
	  			</td>
	  		</tr>
	  		@endfor
	  	</tbody>
	  </tbody>
	</table>
</div>

