<div class="col-md-12">

	<div class="form-group {{ $errors->has('dispatch_date') ? 'has-error' : ''}}">
	  {!! Form::label('company_id', 'Select Company', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-3">
	    {!! Form::select('company_id', $companies, null, ['class' => 'form-control col-md-6 required', 'id' => 'company_id', 'placeholder' => 'Select Company',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>
	  {!! $errors->first('company_id', '<span class="help-inline">:message</span>') !!}
	</div>
	
	<div class="form-group {{ $errors->has('receive_date') ? 'has-error' : ''}}">
	  {!! Form::label('receive_date', 'Stock Receive Date and Invoice Number', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-3">
	    {!! Form::text('receive_date', date('Y-m-d'), ['class' => 'datepicker form-control col-md-6 required', 'id' => 'receive_date',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>

	  <div class="col-md-3">
	    {!! Form::text('receipt_number', $receipt_number, ['class' => 'form-control col-md-6 required', 'id' => 'receipt_number',  'autocomplete' => 'off', 'required' => 'true']) !!}
	  </div>

	  {!! $errors->first('receive_date', '<span class="help-inline">:message</span>') !!}
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

	<div class="form-group {{ $errors->has('party_name') ? 'has-error' : ''}}">
	  {!! Form::label('Party Bill Number Date', '', array('class' => 'col-md-2 control-label')) !!}
	  <div class="col-md-3">
	    {!! Form::text('party_bill_number', null, ['class' => 'form-control col-md-6 required', 'id' => 'party_bill_number',  'autocomplete' => 'off', 'required' => 'true', 'placeholder' => 'Party Bill Number']) !!}
	  </div>

	  <div class="col-md-3">
	    {!! Form::text('party_bill_date', null, ['class' => 'datepicker form-control col-md-6', 'id' => 'party_bill_date',  'autocomplete' => 'off', 'placeholder' => 'Party Bill Date']) !!}
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

</div>

<div class="col-md-12">
<hr>
        <style>
.tableScroll{
    width:1200px;
    max-width:19000px;
    overflow-x:scroll;
}
</style>

	<table class="table table-bordered tableScroll" id="stockin_table">
	  <thead>
	      <tr>
	        <th>
	          Product 
	        </th>

	        <th>
	        	Expiry Date
	        </th>

	        <th>
	        	Batch Number
	        </th>

	        <th>
	          Unit Price(Purchase Rate)
	        </th>

	<th>
	          MRP
	        </th>	

	        <th>
	          Quantity
	        </th>

	        <th>
	          Total Amount
	        </th>

	      </tr>
	  </thead>

	  <tbody>
	  	<tbody>
	  		@for( $i=0; $i <4; $i++)
	  		<tr>
	  			<td class="col-md-3">
	  				{!! Form::select('product_id[]', $products, null, ['class' => 'col-md-12 select2 required', 'id' => 'product_id',   'autocomplete' => 'off']) !!}
	  			</td>

	  			<td class="col-md-2">
	  			{!! Form::text('expiry_date[]', null, ['class' => 'datepicker-years form-control col-md-6 required', 'id' => 'expiry_date',  'autocomplete' => 'off']) !!}
	  			</td> 

	  			<td>
	  			{!! Form::text('batch_number[]', null, ['class' => 'form-control col-md-6 required', 'id' => 'batch_number',  'autocomplete' => 'off']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('unit_cost[]', null, ['class' => 'unit_cost form-control col-md-6 required', 'id' => 'unit_cost', 'step' => '0.01',  'autocomplete' => 'off',  'placeholder' => 'Unit Price']) !!}
	  			</td>

<td>
	  				{!! Form::number('mrp[]', null, ['class' => 'mrp form-control col-md-6 required', 'id' => 'mrp', 'step' => '0.01',  'autocomplete' => 'off',  'placeholder' => 'MRP']) !!}
	  			</td>

	  			<td>
	  				{!! Form::number('quanity[]', null, ['class' => 'quanity form-control col-md-6 required', 'id' => 'quanity',  'autocomplete' => 'off',  'placeholder' => 'Quantity']) !!}
	  			</td>

	  			<td>
	  				{!! Form::text('total_cost[]', null, ['class' => 'total_cost form-control col-md-6 required', 'id' => 'total_cost',  'autocomplete' => 'off', 'placeholder' => 'Total Amount']) !!}
	  			</td>
	  		</tr>
	  		@endfor
	  	</tbody>
	  </tbody>
	</table>
</div>

