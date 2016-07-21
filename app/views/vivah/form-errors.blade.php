@if(Session::has('message'))
<div class="errors">
  <p>{{ Session::get('message') }}</p>
  <ul>
  @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
  </ul>
</div>
@endif
@if(Session::has('success'))
<div class="success">
  <p>{{ Session::get('success') }}</p>
</div>
@endif