@extends('layouts.master', ['title' => $article->title, 'bg' => 'bg-white'])

@push('meta')
    <link rel="canonical" href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}">

    <meta name="description" content="{{ $article->description }}">

    <x-facebook.article
        :url="route('user.articles.show', [$article->type->slug, $article->slug])"
        :title="$article->title"
        :description="$article->description"
        :image="$article->cover_photo"/>

    <x-twitter.card
        :title="$article->title"
        :description="$article->description"
        :image="$article->cover_photo"/>
@endpush

@push('header_scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>

    @include('user.articles.partials.breadcrumb-jsonld')
    @include('user.articles.partials.article-jsonld')
@endpush

@push('footer_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="{{ asset('js/twitter.js') }}"></script>
@endpush

@section('main')
    <div class="container-fluid px-0 py-4 bg-white">
        <div class="container">

            <x-breadcrumb>
                <x-breadcrumb.item><a href="{{ route('user.homepage')  }}">{{ __("Homepage") }}</a></x-breadcrumb.item>
                <x-breadcrumb.item><a href="{{ route('user.articles.index', $type->slug) }}">{{ $type->name }}</a></x-breadcrumb.item>
                <x-breadcrumb.item class="d-none d-md-inline-block" active>{{ $article->title }}</x-breadcrumb.item>
            </x-breadcrumb>

            <main class="row g-4">
                <div class="col-12 col-xl-8">
                    <article>
                        <h1 class="mb-3">{{ $article->title }}</h1>
                        <p class="h5 mb-3">{{ $article->description }}</p>

                        @isset($article->podcast)
                            <div class="mb-3">
                                {!! $article->podcast->url !!}
                            </div>
                        @endisset

                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 text-muted">
                            <div class="d-flex align-items-center mb-3 mb-sm-0">
                                <a href="{{ route('user.articles.index', $type->slug) }}" class="text-decoration-none">
                                    <span class="rounded text-light px-2 py-1" style="background-color: {{ $article->type->color }}">{{ $article->type->name }}</span>
                                </a>
                                <span class="ms-3">{{ $article->created_at->isoFormat('D MMMM YYYY') }}</span>
                            </div>

                            <div class="addthis_sharing_toolbox"></div>
                        </div>

                        @if($article->image && !$article->type->isVideo())
                            <div class="ratio ratio-16x9 mb-4">
                                @if($article->type->isColumn() && isset($article->author->cover_photo))
                                    <img src="{{ $article->author->cover_photo->url() }}" alt="{{ $article->title }}" class="rounded">
                                @else
                                    <img src="{{ $article->image->url() }}" alt="{{ $article->title }}" class="rounded">
                                @endif
                            </div>
                        @endif

                        <div class="d-block text-wrap">
                            {!! $article->content !!}
                        </div>
                        @includeWhen($article->show_images && $article->photos->isNotEmpty(), 'user.articles.partials.article-photos')
                    </article>

                    <x-similar-news :except="$article"/>

                    <div class="mt-3">
                        <div class="d-flex flex-row flex-wrap">
                            @foreach($article->tags as $tag)
                                <a href="{{ route('user.articles.search_by_tag', $tag->slug) }}">
                                    <span class="badge fs-6 fw-normal bg-secondary me-1 mb-1 text-wrap text-start">#{{ $tag->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="row gy-4 row-cols-1 align-items-start">

                        @can('Update article')
                            @include('user.articles.partials.article-info')
                        @endcan

                        @include('user.adv.slot-4')

                        @includeWhen($article->type->isColumn(), 'user.articles.partials.author-info')

                        <div class="col">
                            <x-latest-news :except="$article"/>
                        </div>

                        @include('user.adv.slot-3')
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
