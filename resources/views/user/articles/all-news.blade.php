@extends('layouts.master', ['title' => __("All news")])

@push('meta')
    <meta name="description" content="{{ __("descriptions.all-news") }}">
    <link rel="canonical" href="{{ route('user.articles.all_news') }}">
@endpush

@section('main')
    @include('user.adv.slot-1')

    <div class="container-fluid py-4">
        <div class="container">

            <x-breadcrumb>
                <x-breadcrumb.item><a href="{{ route('user.homepage')  }}">{{ __("Homepage") }}</a></x-breadcrumb.item>
                <x-breadcrumb.item active>{{ __("All news") }}</x-breadcrumb.item>
            </x-breadcrumb>

            <h1 class="fs-2 mb-3">
                <span class="d-inline-block w-auto border-bottom border-danger border-4 pb-2">{{ __("All news") }}</span>
            </h1>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($articles as $article)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}">
                                <div class="ratio ratio-16x9">
                                    @if($article->image)
                                        <img src="{{ $article->image->url('sm') }}" alt="{{ $article->title }}" class="rounded-top">
                                    @else
                                        <x-image.16x9/>
                                    @endif
                                </div>
                            </a>
                            <div class="card-body d-flex flex-column">
                                @include('user.articles.partials.badge', compact('article'))
                                <p class="card-text">
                                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="text-decoration-none text-dark">
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

    @include('user.adv.slot-2')

@endsection
