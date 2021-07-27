<div class="mb-2">
    <span class="badge rounded-pill" style="background-color: {{ $article->type->color }}">
        @if($article->type->isVideo())
            <em class="fa fa-play me-1"></em>
        @endif
        {{ $article->type->name }}
    </span>
</div>
