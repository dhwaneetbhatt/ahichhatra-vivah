@extends('layouts.master')

@section('page')
<div class="container-fluid">
  <div class="row">
    <div class="xol-xs-12 col-sm-8 col-md-9 content">
      @yield('content')
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3 sidebar">
      @include('layouts/sidebar')
    </div>
  </div>
</div>
@include('layouts/footer')
@stop