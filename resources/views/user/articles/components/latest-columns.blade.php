<div class="card shadow-sm">
    <div class="card-header">
        <a class="text-dark fw-bold text-decoration-none" href="{{ route('user.authors.show', $author->slug) }}">{{ __("Author's other columns") }}</a>
    </div>
    @if($articles->isNotEmpty())
        <a href="{{ route('user.articles.show', [$type->slug, $first->slug])}}" class="ratio ratio-16x9">
            @if($first->author->cover_photo)
                <img src="{{ $first->author->cover_photo->url('md') }}" alt="{{ $first->title }}">
            @else
                <x-news::image.16x9/>
            @endif
        </a>
        <div class="card-body">
            @foreach($articles as $article)
                <div class="border-bottom pb-2 mb-2">
                    <a href="{{ route('user.articles.show', [$type->slug, $article->slug])}}" class="text-dark text-decoration-none">{{ $article->title }}</a>
                </div>
            @endforeach
            <a class="text-decoration-none" href="{{ route('user.authors.show', $author->slug) }}">{{ __("All articles") }} &raquo;</a>
        </div>
    @endif
</div>
