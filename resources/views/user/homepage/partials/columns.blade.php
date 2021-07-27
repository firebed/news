<h5 class="mb-2 fw-bold pb-1 border-bottom border-danger border-3"><a href="{{ route('user.articles.index', 'kose-yazilari') }}" class="text-dark text-decoration-none">{{ to_upper(__("Columns")) }}</a></h5>

{{-- For small devices and up --}}
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 d-none d-sm-flex">
    @foreach($columns as $article)
        <div class="col">
            <div class="card shadow-sm h-100 overflow-hidden">
                <div class="card-body p-0">
                    <div class="row gx-2">
                        <div class="col-5 col-sm-12">
                            <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}">
                                <div class="ratio ratio-16x9">
                                    @if($article->author->cover_photo)
                                        <img src="{{ $article->author->cover_photo->url('md') }}" alt="{{ $article->title }}">
                                    @else
                                        <x-image.16x9/>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="col p-1 p-sm-3">
                            <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="text-decoration-none text-dark lc lc-3" style="line-height: 1.5rem">{{ $article->title }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- For mobiles --}}
<x-carousel class="pb-sm-3 d-sm-none" id="columns">
    <x-carousel.inner>
        @foreach($columns as $article)
            <x-carousel.item active="{{ $loop->first }}">
                <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}">
                    <div class="ratio ratio-16x9">
                        @if($article->image)
                            <img src="{{ $article->image->url('md') }}" alt="{{ $article->title }}">
                        @else
                            <x-image.16x9/>
                        @endif
                    </div>
                </a>
                <x-carousel.caption class="d-none d-sm-flex start-0 bottom-0 w-100 text-start gallery-caption">
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="fs-3 fw-bold text-decoration-none text-light text-shadow">{{ $article->title }}</a>
                </x-carousel.caption>
                <div class="fw-bold d-sm-none bg-white p-2 fs-5" style="height: 100px">
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="lc lc-3 text-decoration-none text-dark">{{ $article->title }}</a>
                </div>
            </x-carousel.item>
        @endforeach
    </x-carousel.inner>

    <x-carousel.controls target="#columns"/>
</x-carousel>

<div class="mt-2 fw-bold pb-1 border-bottom border-danger border-3"></div>
