<div class="form-group {{ $errors->has('vendor_name') ? 'has-error' : ''}}" id="vendor_name">
  {!! Form::label('vendor_name', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::text('vendor_name', null, ['class' => 'col-md-8 required', 'id' => 'vendor_name',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('vendor_name', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('vendor_address') ? 'has-error' : ''}}" id="vendor_address">
  {!! Form::label('vendor_address', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::text('vendor_address', null, ['class' => 'col-md-8 required', 'id' => 'vendor_address',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('vendor_address', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('party_dl') ? 'has-error' : ''}}" id="party_dl">
  {!! Form::label('party_dl', 'Party DL', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-9">
    {!! Form::text('party_dl', null, ['class' => 'col-md-8 required', 'id' => 'party_dl',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('party_dl', '<span class="help-inline">:message</span>') !!}
</div

<div class="form-group {{ $errors->has('bill_date') ? 'has-error' : ''}}">
  {!! Form::label('bill_date', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-6">
    {!! Form::text('bill_date', null, ['class' => 'datepicker form-control col-md-6 required', 'id' => 'bill_date',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('bill_date', '<span class="help-inline">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('bill_number') ? 'has-error' : ''}}">
  {!! Form::label('bill_number', '', array('class' => 'col-md-3 control-label')) !!}
  <div class="col-md-5">
    {!! Form::text('bill_number', null, ['class' => 'form-control col-md-6 required', 'id' => 'bill_number',  'autocomplete' => 'off', 'required' => 'true']) !!}
  </div>
  {!! $errors->first('bill_number', '<span class="help-inline">:message</span>') !!}
</div>