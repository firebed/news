@extends('news::layouts.master', ['title' => __("Search")])

@push('meta')
    <link rel="canonical" href="{{ route('user.articles.search_by_tag', $tag->slug) }}">
@endpush

@prepend('header_scripts')
    <meta name="robots" content="noindex">
@endprepend

@section('main')

    @include('news::user.adv.slot-1')

    <div class="container-fluid py-4">
        <div class="container">
            <h1 class="fs-2 mb-3">
                <span class="d-inline-block w-auto border-bottom border-primary border-4 pb-2">{{ Str::ucfirst($tag->name) }}</span>
            </h1>
            @if($articles->isNotEmpty())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach($articles as $article)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}">
                                    <div class="ratio ratio-16x9">
                                        @if($article->image)
                                            <img src="{{ $article->image->url('sm') }}" alt="{{ $article->title }}" class="rounded-top">
                                        @else
                                            <x-news::image.16x9/>
                                        @endif
                                    </div>
                                </a>

                                <div class="card-body d-flex flex-column">
                                    @include('news::user.articles.partials.badge', compact('article'))
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
            @else
                <div class="card bg-gray-200">
                    <div class="card-body p-5 text-center">
                        <img src="{{ asset('storage/images/search.svg') }}" alt="Search">
                        <div class="my-3 h4 text-secondary">{{ __("No results were found") }}</div>
                        <div class="mb-5 text-secondary">{{ __("No results were found matching the search criteria") }}</div>
                        <div>
                            <a href="{{ route('user.articles.all_news') }}" class="btn btn-primary">{{ __("Show all news") }}</a>
                        </div>
                    </div>
                </div>
            @endif

            @if($articles->hasPages())
                <div class="d-flex justify-content-end align-items-center mt-3">
                    {{ $articles->links('news::components.paginator') }}
                </div>
            @endif
        </div>
    </div>

    @include('news::user.adv.slot-2')

@endsection
