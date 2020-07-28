<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  
  <title>Faceper</title>
  <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
  <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<style type="text/css">
	.selector-for-some-widget {
		box-sizing: content-box;
	}
</style>
<body class="">
  <div class="wrapper">
    <div id="app"></div>
  </div>
</body>

<script src="{{ mix('js/app.js') }}"></script>
</html>