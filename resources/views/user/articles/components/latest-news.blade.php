<div class="card shadow-sm">
    <div class="card-header fw-bold">{{ __("Latest news") }}</div>
    @if($articles->isNotEmpty())
        <a href="{{ route('user.articles.show', [$first->type->slug, $first->slug])}}" class="ratio ratio-16x9">
            @if($first->image)
                <img src="{{ $first->image->url('md') }}" alt="{{ $first->title }}">
            @else
                <x-news::image.16x9/>
            @endif
        </a>
        <div class="card-body">
            @foreach($articles as $article)
                <div class="@if(!$loop->last) border-bottom pb-2 mb-2 @endif">
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug])}}" class="text-dark text-decoration-none">{{ $article->title }}</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
