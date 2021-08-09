<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ stripslashes($article->title) }}",
    "image": "{{ $article->image ? $article->image->url() : '' }}",
    "author": "{{ $article->author->full_name ?? $article->user->full_name }}",
    "editor": "Bilal Budur",
    "genre": "{{ $article->type->name }}",
    "keywords": "{{ $article->tags->pluck('name')->join(' ') }}",
    "wordcount": "{{ str_word_count($article->content) }}",
    "publisher": {
        "@type": "Organization",
        "name": "{{ config('app.organization') }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('storage/images/logo.png') }}"
        }
    },
    "url": "http://www.cinarfm.gr",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}"
    },
    "datePublished": "{{ $article->created_at->format('Y-m-d') }}",
    "dateCreated": "{{ $article->created_at->format('Y-m-d') }}",
    "dateModified": "{{ $article->updated_at->format('Y-m-d') }}",
    "description": "{{ stripslashes($article->description) }}",
    "articleBody": "{{ stripslashes(strip_tags($article->content)) }}"
}
</script>
