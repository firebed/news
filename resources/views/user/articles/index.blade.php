@extends('layouts.master', ['title' => __($type->name)])

@push('meta')
    <meta name="description" content="{{ __("descriptions.$type->name") }}">

    @if($articles->onFirstPage())
        @if($articles->hasMorePages())
            <link rel="next" href="{{ $articles->nextPageUrl() }}">
        @endif
        <link rel="canonical" href="{{ route('user.articles.index', $type->slug) }}">

    @elseif($articles->currentPage() === 2)
        <link rel="prev" href="{{ route('user.articles.index', $type->slug) }}">
        <link rel="next" href="{{ $articles->nextPageUrl() }}">
        <link rel="canonical" href="{{ route('user.articles.index', [$type->slug, 'page' => $articles->currentPage()]) }}">

    @elseif($articles->currentPage() === $articles->lastPage())
        <link rel="prev" href="{{ $articles->previousPageUrl() }}">
        <link rel="canonical" href="{{ route('user.articles.index', [$type->slug, 'page' => $articles->currentPage()]) }}">

    @else
        <link rel="prev" href="{{ $articles->previousPageUrl() }}">
        <link rel="next" href="{{ $articles->nextPageUrl() }}">
        <link rel="canonical" href="{{ route('user.articles.index', [$type->slug, 'page' => $articles->currentPage()]) }}">
    @endif
@endpush

@section('main')

{{--    @include('user.adv.slot-1')--}}

    <div class="container-fluid py-4">
        <div class="container">

            <x-news::breadcrumb>
                <x-news::breadcrumb.item><a href="{{ route('user.homepage')  }}">{{ __("Homepage") }}</a></x-news::breadcrumb.item>
                <x-news::breadcrumb.item active>{{ $type->name }}</x-news::breadcrumb.item>
            </x-news::breadcrumb>

            <h1 class="fs-2 mb-3">
                <span class="d-inline-block w-auto border-bottom border-danger border-4 pb-2">{{ __($type->name) }}</span>
            </h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach($articles as $article)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('user.articles.show', [$type->slug, $article->slug]) }}">
                                <div class="ratio ratio-16x9">
                                    @if($article->image)
                                        <img src="{{ $article->image->url('sm') }}" alt="{{ $article->title }}" class="rounded-top">
                                    @else
                                        <x-news::image.16x9/>
                                    @endif
                                </div>
                            </a>

                            <div class="card-body d-flex flex-column">
                                <p class="card-text">
                                    <a href="{{ route('user.articles.show', [$type->slug, $article->slug]) }}" class="text-decoration-none text-dark">
                                        {{ $article->title }}
                                    </a>
                                </p>
                                <p class="card-text mt-auto"><small class="text-muted">{{ $article->created_at->isoFormat('D MMMM YYYY') }}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($articles->hasPages())
                <div class="d-flex justify-content-end align-items-center mt-3">
                    {{ $articles->links('components.paginator') }}
                </div>
            @endif
        </div>
    </div>

{{--    @include('user::user.adv.slot-2')--}}
@endsection
