<div class="form-group {{ $errors->has('receive_date') ? 'has-error' : ''}}">
  {!! Form::label('receive_date', 'Date of Receive', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-6">
    {!! Form::text('receive_date', null, ['class' => 'form-control col-md-6 required', 'id' => 'receive_date',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('receive_date', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('quanity') ? 'has-error' : ''}}">
  {!! Form::label('quanity', 'Quantity', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-5">
    {!! Form::number('quanity', null, ['class' => 'form-control col-md-6 required', 'id' => 'quanity',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('quanity', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('total_cost') ? 'has-error' : ''}}">
  {!! Form::label('total_cost', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-5">
    {!! Form::number('total_cost', null, ['class' => 'form-control col-md-6 required', 'id' => 'total_cost', 'step' => '0.01',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('total_cost', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('product_ids') ? 'has-error' : ''}}" id="product">
  {!! Form::label('product_ids', 'Select Product', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::select('product_ids[]', $products, null, ['class' => 'select2 col-md-8 required', 'id' => 'product_ids',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('product_ids', '<span class="help-inline">:message</span>') !!}
</div>

<div id="morepros"></div>

<div>
{!! Form::label('', ' ', array('class' => 'col-md-3 control-label')) !!}
<a id="add_product" href="#">Add More Product</a>
</div>

