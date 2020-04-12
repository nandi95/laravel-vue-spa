@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>
  <script>
    {{--window.notification = @json(isset($notification) ? $notification : []);--}}
  </script>

  {{-- Load the application scripts --}}
{{--  <script src="{{ mix('js/manifest.js') }}"></script>--}}
{{--  <script src="{{ mix('js/vendor.bundle.js') }}"></script>--}}
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
