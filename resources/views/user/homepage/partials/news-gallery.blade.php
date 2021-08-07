<x-news::carousel class="pb-sm-3 carousel-fade" id="gallery">
    <x-news::carousel.inner>
        @foreach($gallery_news as $article)
            <x-news::carousel.item active="{{ $loop->first }}" :interval="$loop->first ? 8000 : NULL">
                <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}">
                    <div class="ratio ratio-16x9">
                        @if($article->image)
                            <img @if($loop->first) src="{{ $article->image->url() }}" @endif data-src="{{ $article->image->url() }}" alt="{{ $article->title }}">
                        @else
                            <x-news::image.16x9/>
                        @endif
                    </div>
                </a>
                <x-news::carousel.caption class="d-none d-sm-block start-0 bottom-0 w-100 text-start gallery-caption">
                    <div class="mb-3">
                        <span class="py-1 px-3 rounded fw-bold shadow-sm" style="background-color: {{ $article->type->color }}">{{ $article->type->name }}</span>
                    </div>
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="fs-3 fw-bold text-decoration-none text-light text-shadow">{{ to_upper($article->title) }}</a>
                </x-news::carousel.caption>
                <div class="d-sm-none bg-white p-2 position-relative" style="height: 100px">
                    <span class="badge d-sm-none rounded-pill position-absolute py-1 px-3" style="top: -2rem; background-color: {{ $article->type->color }}">{{ $article->type->name }}</span>
                    <a href="{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}" class="fw-bold fs-5 lc lc-3 text-decoration-none text-dark">{{ to_upper($article->title) }}</a>
                </div>
            </x-news::carousel.item>
        @endforeach
    </x-news::carousel.inner>

    <x-news::carousel.controls target="#gallery"/>

    <x-news::carousel.indicators class="mx-0" style="bottom: -19px">
        @foreach($gallery_news as $article)
            <x-news::carousel.indicator class="pt-1 wpx-4 border-0" target="#gallery" slide="{{ $loop->index }}" :active="$loop->first" style="border-bottom: 7px solid #212529 !important; margin: 0 1px !important"/>
        @endforeach
    </x-news::carousel.indicators>
</x-news::carousel>

@push('footer_scripts')
    <script defer>
        window.onload = function () {
            const gallery = document.getElementById("gallery");
            gallery.addEventListener("slide.bs.carousel", function (ev) {
                const lazy = ev.relatedTarget.querySelector("img[data-src]");
                if (lazy) {
                    lazy.src = lazy.getAttribute("data-src");
                    lazy.removeAttribute("data-src");
                }
            });
        }
    </script>
@endpush
