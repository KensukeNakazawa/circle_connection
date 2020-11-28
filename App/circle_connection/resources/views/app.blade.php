<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vue Laravel SPA') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <!-- font awesome -->
{{--    <link href="/css/font-awesome.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<div id="app">
  <body>
  <header-component></header-component>
  {{-- vuexを使ったローディングがまだうまくいっていない --}}
  {{-- <loading-component></loading-component>--}}

  <router-view></router-view>

  <bottom-component></bottom-component>
  </body>

</div>
<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}" defer></script>

</html>

