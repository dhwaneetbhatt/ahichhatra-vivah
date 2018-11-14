@extends('layouts.vivah')

@section('content')
<div class="container">
  <div class="row">
    <div class="xol-xs-12 col-sm-8 col-md-4 col-sm-offset-1">
      <div>
        <div>
          <h3>Please sign in</h3>
        </div>
        <div>
          {{ Form::open(array('url'=>'/login', 'role'=>'form')) }}
            <fieldset>
              <div class="form-group">
                <label class="col-form-label" for="input-email">Email Address</label>
                {{ Form::email('email', null, array('class'=>'form-control', 'id'=>'input-email',
                  'placeholder'=>'Email Address', 'required'=>'required')) }}
              </div>
              <div class="form-group">
                <label class="col-form-label" for="input-password">Password</label>
                {{ Form::password('password', array('class'=>'form-control', 'id'=>'input-password',
                  'placeholder'=>'Password', 'required'=>'required')) }}
              </div>
              <div class="form-group">
                {{ Form::submit('Login', array('class'=>'form-control left btn btn-primary'))}}
              </div>
              <div class="form-group">
                <div class='action-link'>Forgot Password? Click {{ HTML::link(action('RemindersController@getRemind'), 'here') }} to reset.</div>
              </div>
              <div class="form-group">
                <div class='action-link'>New user? Register {{ HTML::link('/register', 'here') }}</div>
              </div>
            </fieldset>
          {{ Form::close() }}
          @include('vivah/form-errors')
          <div>
            <h4>Disclaimer</h4>
            <p>The information provided here is directly enrolled by the candidates. The Ahichhatra Sanskar Kendra is not responsible for the correctness of the particulars therein. Please contact relevant persons directly for more details.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop