@extends('layouts.vivah')

@section('content')
<div class="container">
  <div class="col-xs-12 col-sm-6 col-md-4">
    <div>
      <h3>Reset Password</h3>
    </div>
    <div>
      {{ Form::open(array('action'=>'RemindersController@postRemind', 'role'=>'form')) }}
      <fieldset>
        <div class="form-group">
          <label class="col-form-label" for="input-email">Email Address</label>
          {{ Form::email('email', null, array('class'=>'form-control', 'id'=>'input-email',
            'placeholder'=>'Email Address', 'required'=>'required')) }}
        </div>
        <div class="form-group">
          {{ Form::submit('Reset Password', array('class'=>'form-control left btn btn-primary'))}}
        </div>
      </fieldset>
      {{ Form::close() }}
      @include('vivah/form-errors')
    </div>
  </div>
</div>
@stop