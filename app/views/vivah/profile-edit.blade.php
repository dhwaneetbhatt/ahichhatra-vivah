@extends('vivah.vivah-home')

@section('vivah-section')
<div class="col-xs-12 col-sm-8 col-md-6">
  <div class="row">
    <div>
      {{ Form::model($profile, array('route' => array('profile.edit'),
                                     'method' => 'PUT',
                                     'class' => 'form-horizontal',
                                     'files' => true)) }}
        {{ Form::hidden('id') }}
        <fieldset>
          <div class="form-group">
            {{ Form::label('photo', 'Photo', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              <div class="form-group row">
                <div class="col-sm-4 img-container">
                  <img src="{{ $profile->photo }}" />
                </div>
                <div class="col-sm-2">
                  <input type="file" name="photo", accept="image/*">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('name', 'Name', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('name', null, array('class'=>'form-control', 'required'=>'required')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('father_name', 'Father\'s Name', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('father_name', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('mother_name', 'Mother\'s Name', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('mother_name', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('gender', 'Gender', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::select('gender', array('male' => 'Male', 'female' => 'Female'), null,
                 array('class'=>'form-control'))
              }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('birthdate', 'Date of Birth', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::input('date', 'birthdate', null, array('class'=>'form-control', 'required'=>'required')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('birthtime', 'Time of Birth', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::input('time', 'birthtime', null, array('class'=>'input-time form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('birthplace', 'Place of Birth', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('birthplace', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('height', 'Height', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('height', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('current_city', 'Current City', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('current_city', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('', '', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              <div class="form-group row">
                {{ Form::label('vatan', 'વતન', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                  {{ Form::text('vatan', null, array('class'=>'form-control')) }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('', '', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              <div class="form-group row">
                {{ Form::label('gotra', 'ગોત્ર', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                  {{ Form::text('gotra', null, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('rashi', 'રાશી', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                  {{ Form::text('rashi', null, array('class'=>'form-control')) }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('', '', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              <div class="form-group row">
                {{ Form::label('nadi', 'નાડી', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                  {{ Form::text('nadi', null, array('class'=>'form-control')) }}
                </div>
                {{ Form::label('nakshtra', 'નક્ષત્ર', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                  {{ Form::text('nakshtra', null, array('class'=>'form-control')) }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('permanent_address', 'Permanent Address', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::textarea('permanent_address', null, array('class'=>'form-control', 'rows'=>'3')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('primary_number', 'Mobile/Phone Number', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('primary_number', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('education', 'Educational Qualification', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::textarea('education', null, array('class'=>'form-control', 'rows'=>'2')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('hobbies', 'Hobbies', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::textarea('hobbies', null, array('class'=>'form-control', 'rows'=>'2')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('job_description', 'Job Description', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::textarea('job_description', null, array('class'=>'form-control', 'rows'=>'3')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('salary', 'Salary', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('salary', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('secondary_address', 'Office/Other Address', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::textarea('secondary_address', null, array('class'=>'form-control', 'rows'=>'3')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('secondary_number', 'Office/Other Numbers', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::text('secondary_number', null, array('class'=>'form-control')) }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('references', 'Two References', array('class'=>'col-sm-3 control-label')) }}
            <div class="col-sm-9">
              {{ Form::textarea('references', null, array('class'=>'form-control', 'rows'=>'4')) }}
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-2">
              {{ Form::submit('Save', array('class'=>'form-control btn btn-primary'))}}
            </div>
          </div>
        </fieldset>
      {{ Form::close() }}
    </div>
  </div>
</div>
<div class="xol-xs-8 col-sm-4 vert-offset-top-3">
  @include('vivah/form-errors')
</div>
@stop