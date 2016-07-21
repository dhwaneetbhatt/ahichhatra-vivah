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
        {{ Form::password('current_password', array('class'=>'form-control', 'placeholder'=>'Current Password', 'required'=>'required')) }}
      </div>
      <div class="form-group">
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'New Password', 'required'=>'required')) }}
      </div>
      <div class="form-group">
        {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm New Password', 'required'=>'required')) }}
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
