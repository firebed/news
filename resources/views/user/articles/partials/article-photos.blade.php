<div class="mt-3 row g-2 row-cols-2 row-cols-lg-4">
    @foreach($article->photos as $photo)
        <div class="col">
            <a data-fancybox="gallery" href="{{ $photo->url() }}" data-caption="{{ $article->title }}">
                <div class="ratio ratio-16x9">
                    <img src="{{ $photo->url('sm') }}" alt="{{ $photo->title }}" class="img-auto rounded">
                </div>
            </a>
        </div>
    @endforeach
</div>
