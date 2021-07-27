@extends('layouts.master', ['title' => __("Authors")])

@push('meta')
    <meta name="description" content="{{ __("descriptions.authors") }}">
    <link rel="canonical" href="{{ route('user.authors.index') }}">
@endpush

@section('main')

    @include('user.adv.slot-1')

    <div class="container-fluid py-4">
        <div class="container">

            <x-breadcrumb>
                <x-breadcrumb.item><a href="{{ route('user.homepage')  }}">{{ __("Homepage") }}</a></x-breadcrumb.item>
                <x-breadcrumb.item active>{{ __("Authors") }}</x-breadcrumb.item>
            </x-breadcrumb>

            <h1 class="fs-2 mb-3">
                <span class="d-inline-block w-auto border-bottom border-danger border-4 pb-2">{{ __("Authors") }}</span>
            </h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach($authors as $author)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header">
                                <a href="{{ route('user.authors.show', $author->slug) }}" class="fw-bold text-decoration-none text-dark">{{ $author->full_name }}</a>
                            </div>
                            <a href="{{ route('user.articles.show', [$type->slug, $author->articles->first()->slug])}}">
                                <div class="ratio ratio-16x9">
                                    @if($author->articles->first()->image)
                                        <img src="{{ $author->articles->first()->image->url() }}" alt="{{ $author->articles->first()->title }}">
                                    @else
                                        <div class="bg-white"></div>
                                    @endif
                                </div>
                            </a>
                            <ul class="card-body d-flex flex-column h-100 py-0">
                                @foreach($author->articles as $article)
                                    <div class="col border-bottom py-2 d-flex align-items-center">
                                        <a href="{{ route('user.articles.show', [$type->slug, $article->slug])}}" class="text-decoration-none text-dark lc lc-2">{{ $article->title }}</a>
                                    </div>
                                @endforeach
                                <a href="{{ route('user.authors.show', $author->slug) }}" class="text-decoration-none mt-2">
                                    {{ __("All articles") }} ({{ $author->articles_count }})
                                </a>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
