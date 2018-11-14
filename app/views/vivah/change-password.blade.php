@extends('vivah.vivah-home')

@section('vivah-section')
<div class="col-xs-12 col-sm-6 col-md-4">
  <div>
    <h3>Change Password</h3>
  </div>
  <div>
    {{ Form::open(array('url'=>'/changepassword', 'role'=>'form')) }}
    <fieldset>
      <div class="form-group">
        <label class="col-form-label" for="input-current-password">Current Password</label>
        {{ Form::password('current_password', array('class'=>'form-control', 'id'=>'input-current-password',
          'placeholder'=>'Current Password', 'required'=>'required')) }}
      </div>
      <div class="form-group">
        <label class="col-form-label" for="input-new-password">New Password</label>
        {{ Form::password('password', array('class'=>'form-control', 'id'=>'input-new-password',
          'placeholder'=>'New Password', 'required'=>'required')) }}
      </div>
      <div class="form-group">
        <label class="col-form-label" for="input-confirm-password">Confirm New Password</label>
        {{ Form::password('password_confirmation', array('class'=>'form-control', 'id'=>'input-confirm-password',
          'placeholder'=>'Confirm New Password', 'required'=>'required')) }}
      </div>
      <div class="form-group">
        {{ Form::submit('Change', array('class'=>'form-control left btn btn-primary'))}}
      </div>
    </fieldset>
    {{ Form::close() }}
  </div>
  @include('vivah/form-errors')
</div>
@stop
