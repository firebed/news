<h5 class="mb-2 fw-bold pb-1 border-bottom border-primary border-3">{{ __("Podcast") }}</h5>

@if($podcasts->isNotEmpty())
    <div class="d-flex flex-column" style="gap: 2.2rem">
        @foreach($podcasts as $article)
            <div class="row g-2">
                <div class="col-5">
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug])}}">
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
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug])}}" class="text-dark fs-6 lc lc-3 mb-0 text-decoration-none" style="font-weight: 500">{{ $article->title }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endif
