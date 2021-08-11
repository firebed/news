<div class="col">
    <x-news::heading-tag color="{{ $type->color }}">
        <a href="{{ route('user.articles.index', $type->slug) }}">{{ __($type->name) }}</a>
    </x-news::heading-tag>

    @if($type->articles->isNotEmpty())
        <div class="position-relative mb-3">
            <a href="{{ route('user.articles.show', [$type->slug, $type->articles->first()->slug])}}">
                <div class="ratio ratio-16x9">
                    @if($type->articles->first()->image)
                        <img src="{{ $type->articles->first()->image->url('md') }}" alt="{{ $type->articles->first()->title }}">
                    @else
                        <x-news::image.16x9/>
                    @endif
                </div>
                <div class="position-absolute start-0 w-100 bottom-0" style="height: 60%; background-image: linear-gradient(transparent, #1e1e1e)"></div>
                <span class="position-absolute start-0 w-100 bottom-0 fs-5 fw-bold p-3 text-light text-decoration-none text-shadow" style="text-shadow: 0 0 3px #000">{{ $type->articles->first()->title }}</span>
            </a>
        </div>

        <div class="d-flex flex-column">
            @foreach($type->articles->skip(1) as $article)
                <div class="row g-2 mb-3">
                    <div class="col-5">
                        <a href="{{ route('user.articles.show', [$type->slug, $article->slug])}}">
                            <div class="ratio ratio-16x9">
                                @if($article->image)
                                    <img src="{{ $article->image->url('sm') }}" alt="{{ $article->title }}">
                                @else
                                    <x-news::image.16x9/>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col d-flex flex-column">
                        <small class="d-none d-xl-block text-secondary mb-1"><em class="far fa-clock me-1"></em> {{ $article->created_at->isoFormat('D MMMM YYYY') }}</small>
                        <a href="{{ route('user.articles.show', [$type->slug, $article->slug])}}" class="text-dark fs-6 lc lc-3 mb-0 text-decoration-none" style="font-weight: 500">{{ $article->title }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
