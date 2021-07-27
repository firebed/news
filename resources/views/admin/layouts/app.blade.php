<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials.google-analytics')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('meta')

    <title>{{ $title ?? '' }} - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous"/>
    <link href="{{ mix('css/dashboard.css') }}" rel="stylesheet">
    @stack('header_scripts')
    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
</head>
<body class="container-fluid bg-light">
<div class="row">
    @livewire('admin.navigation')
    <main class="col-12 col-lg-9 col-xxl-10">
        {{ $slot }}
    </main>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@livewireScripts
@stack('footer_scripts')
</body>
</html>
