@extends('layouts.vivah')

@section('content')
<div class="row vert-offset-top-2">
  <div class="col-xs-8 col-sm-3 col-md-2 vivah-menu">
    <ul class="nav nav-pills nav-stacked vivah-menu-nav">
      @if($user->isApproved())
      <li>{{ HTML::link('/profiles', 'Profiles') }}</li>
      @endif
      @if($user->isAdmin())
      <li>{{ HTML::link('/admin/profiles?status=NEW', 'New Registrations') }}</li>
      <li>{{ HTML::link('/admin/profiles?status=INCOMPLETE', 'Incomplete Profiles') }}</li>
      <li>{{ HTML::link('/admin/profiles?status=EDITED', 'Edited Profiles') }}</li>
      <li>{{ HTML::link('/admin/profiles?status=DISAPPROVED', 'Disapproved Profiles') }}</li>
      <li>{{ HTML::link('/admin/profiles?status=DELETED', 'Deleted Profiles') }}</li>
      @endif
      @if(!$user->isAdmin())
      <li>{{ HTML::link('/profiles/'.$user->id, 'My Profile') }}</li>
      <li>{{ HTML::link('/profiles/'.$user->id.'/edit', 'Edit Profile') }}</li>
      @endif
      <li>{{ HTML::link('/changepassword', 'Change Password') }}</li>
      <li>{{ HTML::link('/logout', 'Logout') }}</li>
    </ul>
  </div>
  @yield('vivah-section')
</div>
@stop
