@if($articles->isNotEmpty())
    <div class="col-12 mt-3">
        <div class="d-flex mb-3" style="border-bottom: 2px solid #546e7a">
            <div class="position-relative mb-0 text-light fs-5 fw-bold text-decoration-none py-1 px-3" style="background-color: #546e7a">
                {{ __('Similar News') }}
                <span style="position: absolute; content: ''; top: 0; right: -8px; border-top: 8px solid #546e7a; border-right: 8px solid transparent;"></span>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach($articles as $article)
                <div class="col @if($loop->index > 2) d-none d-sm-block @endif">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug])}}" class="ratio ratio-16x9 rounded-top">
                            @if($article->image)
                                <img src="{{ $article->image->url('md') }}" alt="{{ $article->title }}" class="rounded-top">
                            @else
                                <x-news::image.16x9/>
                            @endif
                        </a>
                        <div class="card-body">
                            @include('user.articles.partials.badge', compact('article'))
                            <p><a href="{{ route('user.articles.show', [$article->type->slug, $article->slug])}}" class="text-dark text-decoration-none">{{ $article->title }}</a></p>
                            <div class="small text-secondary">{{ $article->created_at->isoFormat('D MMMM YYYY') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
