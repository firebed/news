<div class="col">
    <div class="card shadow-sm">
        <div class="card-body d-flex">
            @if($article->author->image)
                <x-avatar url="{{ $article->author->image->url() }}"/>
            @endif
            <div class="d-flex flex-column ms-3">
                <strong>{{ $article->author->full_name }}</strong>
                <span class="text-secondary">{{ $article->author->email }}</span>
                <span class="text-secondary">{{ __("Total articles") }}: {{ $article->author->articles()->count() }}</span>
            </div>
        </div>
    </div>
</div>

<div class="col">
    <x-latest-columns :except="$article" take="5"/>
</div>
