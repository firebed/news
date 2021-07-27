<script type="application/ld+json">
    {
		"@context": "https://schema.org",
		"@type": "WebPage",
		"@id": "{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}",
		"url": "{{ route('user.articles.show', [$article->type->slug, $article->slug]) }}"
    }
</script>
