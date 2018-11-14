@extends('layouts.vivah')

@section('content')
<div class="row vert-offset-top-2">
  <div class="col-xs-8 col-sm-3 col-md-2 vivah-menu">
    <ul class="nav flex-column vivah-menu-nav">
      @if($user->isApproved())
      <li class="nav-item">
        <a class="nav-link" href="/profiles">Profiles</a>
      </li>
      @endif
      @if($user->isAdmin())
      <li class="nav-item">
        <a class="nav-link" href="/admin/profiles?status=NEW">New Registrations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/profiles?status=INCOMPLETE">Incomplete Profiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/profiles?status=EDITED">Edited Profiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/profiles?status=DISAPPROVED">Disapproved Profiles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin/profiles?status=DELETED">Deleted Profiles</a>
      </li>
      @endif
      @if(!$user->isAdmin())
      <li class="nav-item">
        <a class="nav-link" href="/profiles/{{$user->id}}">My Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/profiles/{{$user->id}}/edit">Edit Profile</a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="/changepassword">Change Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
    </ul>
  </div>
  @yield('vivah-section')
</div>
@stop
