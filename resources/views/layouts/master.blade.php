<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @include('layouts.partials.google-analytics')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('meta')

    <title>{{ $title }} - Millet Gazetesi</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script data-ad-client="ca-pub-8968304487672528" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.2.1/dist/cdn.min.js"></script>

    @stack('header_links')
    @stack('header_scripts')
</head>
<body class="{{ $bg ?? 'bg-light' }}">

<x-toast-container id="toasts"/>

@include('layouts.partials.header')
@yield('main')
@include('layouts.partials.footer')
@include('cookieConsent::index')

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5305c70751a101db"></script>
<script src="{{ mix('js/app.js') }}"></script>
@stack('footer_scripts')

</body>
</html>
