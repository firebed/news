<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('news::layouts.partials.google-analytics')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('meta')

    <title>{{ $title ?? '' }} - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous"/>
    <link href="{{ mix('css/dashboard/app.css') }}" rel="stylesheet">
    @stack('header_scripts')

    <script defer src="https://unpkg.com/alpinejs@3.2.1/dist/cdn.min.js"></script>
    <script src="{{ mix('js/dashboard/app.js') }}"></script>
</head>
<body class="bg-light">
<div class="container-fluid">
    <div class="row">
        @include('news::dashboard.layouts.partials.navigation')
        <main class="col-12 col-lg-9 col-xxl-10">
            @yield('main')
        </main>
    </div>
</div>
@stack('footer_scripts')
</body>
</html>
