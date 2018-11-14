@extends('vivah.vivah-home')

@section('vivah-section')
<div class="col-xs-12 col-sm-8 col-md-offset-1">
  @if(count($profiles)==0)
    <h4>No profiles yet...Check back later.</h4>
  @endif
  <div class="profiles-table table-responsive">
    <table class="table table-hover">
      <thead>
        <tr class='table-danger'>
          @if($user->isAdmin())
          <th>ID</th>
          @endif
          <th>Name</th>
          <th>Age</th>
          <th>City</th>
          <th>ગોત્ર</th>
        </tr>
      </thead>
      <tbody>
        @foreach($profiles as $profile)
        <tr class='table-warning'>
          @if($user->isAdmin())
          <td>{{ $profile->id }}</td>
          @endif
          <td>{{ HTML::link('/profiles/'.$profile->id, $profile->name) }}</td>
          <td>{{ date_diff(date_create($profile->birthdate), date_create('today'))->y }} years</td>
          <td>{{ $profile->current_city }}</td>
          <td>{{ $profile->gotra }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  <div>
  {{ $profiles->links() }}
</div>
@stop