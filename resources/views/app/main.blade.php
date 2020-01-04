<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name') . (request()->path() === '/' ? '' : ' | ')}}@yield('title')</title>
  @stack('meta')
  @if(asset('images/website/logo.png'))
    <link rel="shortcut icon" type="image/png" href="{{asset('images/website/logo.png')}}"/>
  @endif
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}" id="_csrf">
  <!-- Fonts -->
  <!-- Styles -->
{{--  <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">--}}
  @stack('styles')
  <noscript>
    <em>Please enable Javascript</em>
  </noscript>
</head>
<body>
<div >
  @isset($user)
    @yield('app')
  @else
    @yield('public')
  @endisset
</div>

</body>
<!-- Scripts -->
{{--<script src="{{ mix('js/manifest.js') }}"></script>--}}
{{--<script src="{{ mix('js/vendor.bundle.js') }}"></script>--}}
{{--<script src="{{ mix('js/app.bundle.js') }}"></script>--}}
@stack('scripts')
</html>
