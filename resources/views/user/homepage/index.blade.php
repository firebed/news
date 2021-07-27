@extends('layouts.master', ['title' => __("Batı Trakya | Yunanistan | Türkiye Haberleri")])

@push('meta')
    <meta name="description" content="{{ __("descriptions.homepage") }}">
    <link rel="canonical" href="{{ route('user.homepage') }}">
@endpush

@push('header_scripts')
    @include('user.homepage.partials.website-jsonld')
@endpush

@section('main')

    @include('user.adv.slot-1')

    <div class="container-fluid px-0 py-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-lg-7 col-xl-8">
                    @include('user.homepage.partials.news-gallery')
                </div>
                <div class="col-12 col-lg-5 col-xl-4">
                    @include('user.homepage.partials.greek-articles')
                </div>
            </div>
        </div>
    </div>

    @include('user.adv.slot-2')

    <div class="container-fluid px-0 py-3 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-xl-8">
                    @include('user.homepage.partials.columns')
                </div>

                <div class="col-12 col-xl-4">
                    @include('user.homepage.partials.podcasts')
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-0 py-3 bg-white">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 g-4">
                @each('user.homepage.partials.types', $types, 'type')
            </div>
        </div>
    </div>

    @include('user.adv.slot-2')

    <div class="container-fluid px-0 py-3 bg-dark">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @each('user.homepage.partials.footer_types', $footer_types, 'type')
            </div>
        </div>
    </div>
@endsection
