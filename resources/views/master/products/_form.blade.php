<<<<<<< HEAD
<div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
  {!! Form::label('company_id', 'Select Company', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::select('company_id', $companies, null, ['class' => 'form-control required', 'id' => 'company_id', 'placeholder' => 'Select Company', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('company_id', '<span class="help-inline">:message</span>') !!}
</div>

=======
>>>>>>> a6359495d6e02978b5722dc597581fdfd35df2c7
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('name', 'Product Name', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::text('name', null, ['class' => 'form-control required', 'id' => 'name', 'placeholder' => 'Product Name', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('name', '<span class="help-inline">:message</span>') !!}
<<<<<<< HEAD
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
  {!! Form::label('quantity', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::text('quantity', null, ['class' => 'form-control required', 'id' => 'name', 'placeholder' => 'Quantity', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('quantity', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('mrp') ? 'has-error' : ''}}">
  {!! Form::label('mrp', 'MRP ', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-4">
    {!! Form::number('mrp', null, ['class' => 'form-control required', 'id' => 'mrp', 'placeholder' => 'MRP', 'step' => '0.01', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('mrp', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('trade') ? 'has-error' : ''}}">
  {!! Form::label('trade', 'Trade ', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-4">
    {!! Form::number('trade', null, ['class' => 'form-control required', 'id' => 'trade', 'placeholder' => 'Trade', 'step' => '0.01', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('trade', '<span class="help-inline">:message</span>') !!}
</div> 

<div class="form-group {{ $errors->has('stock_in_hand') ? 'has-error' : ''}}">
  {!! Form::label('stock_in_hand', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-4">
    {!! Form::number('stock_in_hand', null, ['class' => 'form-control required', 'id' => 'stock_in_hand', 'placeholder' => 'Stock in hand', 'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('stock_in_hand', '<span class="help-inline">:message</span>') !!}
=======
>>>>>>> a6359495d6e02978b5722dc597581fdfd35df2c7
</div>