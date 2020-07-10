<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Faceper</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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

<script src="{{ asset('js/app.js') }}"></script>
</html>