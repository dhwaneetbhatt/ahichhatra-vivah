@extends('layouts.vivah')

@section('content')
<div class="container">
  <div class="row">
    <div class="xol-xs-12 col-sm-8 col-md-4 col-sm-offset-1">
      <div>
        <div>
          <h3>Register</h3>
        </div>
        <div>
          {{ Form::open(array('url'=>'/register', 'role'=>'form')) }}
          <fieldset>
            <div class="form-group">
              <label class="col-form-label" for="input-full-name">Full Name</label>
              {{ Form::text('name', null,
                 array('class'=>'form-control', 'id'=> 'input-full-name', 
                 'placeholder'=>'Full Name', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              <label class="col-form-label" for="input-gender">Gender</label>
              {{ Form::select('gender', array('male' => 'Male', 'female' => 'Female'), null,
                 array('class'=>'form-control', 'id'=> 'input-gender', 'placeholder'=>'Gender'))
              }}
            </div>
            <div class="form-group">
              <label class="col-form-label" for="input-email">Email Address</label>
              {{ Form::email('email', null, array('class'=>'form-control', 'id'=> 'input-email',
                'placeholder'=>'Email', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              <label class="col-form-label" for="input-primary-number">Mobile/Phone Number</label>
              {{ Form::input('tel', 'primary_number', null, array('class'=>'form-control', 'id'=> 'input-primary-number',
                'placeholder'=>'Mobile/Phone Number', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              <label class="col-form-label" for="input-birthdate">Birthdate</label>
              {{ Form::input('date', 'birthdate', null, array('class'=>'form-control', 'id'=> 'input-birthdate',
                'placeholder'=>'Date of Birth', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              <label class="col-form-label" for="input-password">Password</label>
              {{ Form::password('password', array('class'=>'form-control', 'id'=> 'input-password',
                'placeholder'=>'Password', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              <label class="col-form-label" for="input-confirm-password">Confirm Password</label>
              {{ Form::password('password_confirmation', array('class'=>'form-control', 'id'=> 'input-confirm-password',
                'placeholder'=>'Confirm Password', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              {{ Form::submit('Register', array('class'=>'form-control left btn btn-success'))}}
            </div>
            <div class="form-group">
              <div class='action-link'>Already registered? Login {{ HTML::link('/login', 'here') }}</div>
            </div>
          </fieldset>
          {{ Form::close() }}
        </div>
      </div>
    </div>
    <div class="xol-xs-8 col-sm-4 col-md-3 vert-offset-top-3">
      @include('vivah/form-errors')
    </div>
  </div>
</div>
@stop