@extends('vivah.vivah-home')

@section('vivah-section')
<div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-1">
    @if(count($profiles)==0)
      <h4>No profiles yet...Check back later.</h4>
    @endif
    @foreach($profiles as $profile)
      <div class="row" id="profile-{{ $profile->id }}">
        <div class="panel panel-danger">
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-6 col-md-3 img-container" align="center">
                <a href="/profiles/{{$profile->id}}">
                  <img alt="Profile Photo" src="{{ $profile->photo}}" class="img-square">
                </a>
              </div>
              <div class="col-sm-6">
                <table class="table">
                  <tbody>
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
                      <td>Name</td>
                      <td>{{ $profile->name }}</td>
                    </tr>
                    <tr>
                      <td>Age</td>
                      <td>{{ date_diff(date_create($profile->birthdate), date_create('today'))->y }} years</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    {{ $profiles->appends(array('status' => $status))->links() }}
</div>
@stop