<div class="mb-4">
    <h1 class="fs-5">{{ $title }}</h1>
    <div class="d-flex">
        <a href="{{ route('admin.articles.index') }}" class="text-decoration-none text-secondary"><em class="fa fa-chevron-left me-1"></em> {{ __("All articles") }}</a>
        <span class="px-3 text-secondary">&bullet;</span>
        <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="text-decoration-none text-secondary" target="_blank"><em class="fa fa-eye me-1"></em> {{ __("View on website") }}</a>
    </div>
</div>
