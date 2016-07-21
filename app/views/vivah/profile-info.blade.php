@extends('vivah.vivah-home')

@section('vivah-section')
<div class="col-xs-12 col-sm-8 col-md-offset-1">
  <div class="panel panel-warning">
    <div class="panel-heading text-center">
      <h3 class="panel-title">{{ $profile->name }}</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 img-container" align="center">
          <img alt="Profile Photo" src="{{ $profile->photo}}" class="img-square">
        </div>
        <div class="col-md-9">
          <table class="table">
            <tbody>
              @if($user->isAdmin())
              <tr>
              @if($profile->status->name == 'DELETED')
                <td><button class="btn btn-success btn-accept" id="btn-accept-{{ $profile->id }}">Undelete</button></td>
                <td><button class="btn btn-danger btn-purge" id="btn-purge-{{ $profile->id }}">Purge</button></td>
              @else
                @if($profile->status->name == 'NEW')
                  <td><button class="btn btn-success btn-accept" id="btn-accept-{{ $profile->id }}">Accept</button></td>
                @else
                  <td><button class="btn btn-primary btn-approve" id="btn-approve-{{ $profile->id }}">Approve</button></td>
                @endif
                <td><button class="btn btn-warning btn-disapprove" id="btn-disapprove-{{ $profile->id }}">Disapprove</button></td>
                <td><button class="btn btn-danger btn-delete" id="btn-delete-{{ $profile->id }}">Delete</button></td>
              @endif
              </tr>
              <tr>
                  <td>ID</td>
                  <td>{{ $profile->id }}</td>
              </tr>
              <tr>
                  <td>{{ HTML::link('/profiles/'. $profile->id . '/edit', 'Edit Profile') }}</td>
              </tr>
              @endif
              <tr>
                <td>Age</td>
                <td>{{ date_diff(date_create($profile->birthdate), date_create('today'))->y }} years</td>
              </tr>
              <tr>
                <td>Date of Birth</td>
                <td>{{ date("d M Y",strtotime($profile->birthdate)) }}</td>
              </tr>
              <tr>
                <td>Time of Birth</td>
                <td>{{ date("h:i a",strtotime($profile->birthtime)) }}</td>
              </tr>
              @foreach ($properties as $key => $value)
                <tr>
                  <td>{{ $value }}</td>
                  <td>{{ $profile[$key] }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop