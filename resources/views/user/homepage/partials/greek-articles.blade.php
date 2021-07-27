<div>
    <h5 class="fw-bold fs-4 mb-4 border-start border-4 ps-2 border-danger">
        <a href="{{ route('user.articles.index', $greek_articles->slug) }}" class="text-decoration-none">ΕΙΔΗΣΕΙΣ - ΆΡΘΡΑ</a>
    </h5>

    @foreach($greek_articles->articles as $article)
        <div class="row g-2 mb-3">
            <div class="col-5">
                <a href="{{ route('user.articles.show', [$greek_articles->slug, $article->slug])}}">
                    <div class="ratio ratio-16x9">
                        @if($article->image)
                            <img src="{{ $article->image->url('sm') }}" alt="{{ $article->title }}">
                        @else
                            <x-image.16x9/>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col d-flex flex-column">
                <small class="d-none d-xl-block text-secondary mb-1"><em class="far fa-clock me-1"></em> {{ $article->created_at->isoFormat('D MMMM YYYY') }}</small>
                <a href="{{ route('user.articles.show', [$greek_articles->slug, $article->slug])}}" class="text-dark fs-6 lc lc-3 mb-0 text-decoration-none" style="font-weight: 500">{{ $article->title }}</a>
            </div>
        </div>
    @endforeach
</div>
