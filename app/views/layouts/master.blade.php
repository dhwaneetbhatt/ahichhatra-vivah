<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="UTF-8">
  {{ HTML::script('js/modernizr.min.js') }}
  {{ HTML::style('css/bootstrap.min.css') }}
  {{ HTML::style('css/bootstrap-theme.min.css') }}
  {{ HTML::style('css/jquery.datetimepicker.min.css') }}
  {{ HTML::style('css/main.css') }}
  {{ HTML::script('js/newrelic.min.js') }}
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>અહિચ્છત્ર સંસ્કાર કેન્દ્ર</title>
</head>
<body>
  @include('layouts/header')
  @yield('page')
</body>
  {{ HTML::script('js/jquery.min.js') }}
  {{ HTML::script('js/jquery.datetimepicker.min.js') }}
  {{ HTML::script('js/main.js') }}
</html>
