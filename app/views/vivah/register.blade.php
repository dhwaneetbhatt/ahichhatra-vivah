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
              {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Full Name', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              {{ Form::select('gender', array('male' => 'Male', 'female' => 'Female'), null,
                 array('class'=>'form-control', 'placeholder'=>'Gender'))
              }}
            </div>
            <div class="form-group">
              {{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'Email', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              {{ Form::input('tel', 'primary_number', null, array('class'=>'form-control', 'placeholder'=>'Mobile/Phone Number', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              {{ Form::label('birthdate', 'Birthdate', array('class'=>'')) }}
              {{ Form::input('date', 'birthdate', null, array('class'=>'form-control', 'placeholder'=>'Date of Birth', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password', 'required'=>'required')) }}
            </div>
            <div class="form-group">
              {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password', 'required'=>'required')) }}
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