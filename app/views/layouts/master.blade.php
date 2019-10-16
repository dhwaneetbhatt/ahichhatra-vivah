<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="UTF-8">
  {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js') }}
  {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css') }}
  {{ HTML::style('css/main.css') }}
  {{ HTML::script('js/newrelic.min.js') }}
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>અહિચ્છત્ર સંસ્કાર કેન્દ્ર</title>
</head>
<body>
  @include('layouts/header')
  @yield('page')
</body>
  {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}
  {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js') }}
  {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css') }}
  {{ HTML::script('js/main.js') }}
</html>
