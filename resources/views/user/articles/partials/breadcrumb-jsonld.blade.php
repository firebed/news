<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "{{ $article->type->name }}",
                "item": "{{ route('user.articles.index', $article->type->slug) }}"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ $article->title }}",
                "item": "{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}"
            }
        ]
    }
</script>
