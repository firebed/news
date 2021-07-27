<div class="col">
    <div class="card shadow-sm h-100 border-dark">
        <div class="card-header">
            <a href="{{ route('user.articles.index', $type->slug) }}" class="fs-5 fw-bold text-dark text-decoration-none">{{ __($type->name) }}</a>
        </div>
        @if($type->articles->isNotEmpty())
            <a href="{{ route('user.articles.show', [$type->slug, $type->articles->first()->slug])}}">
                <div class="ratio ratio-16x9">
                    @if($type->articles->first()->image)
                        <img src="{{ $type->articles->first()->image->url('sm') }}" alt="{{ $type->articles->first()->title }}">
                    @else
                        <x-image.16x9/>
                    @endif
                </div>
            </a>
            <div class="d-flex flex-column h-100">
                @foreach($type->articles as $article)
                    <div class="col @if(!$loop->last) border-bottom @endif px-3 py-2 d-flex align-items-center">
                        <a href="{{ route('user.articles.show', [$type->slug, $article->slug]) }}" class="lc-2 text-dark text-decoration-none">{{ $article->title }}</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
