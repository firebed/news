<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ addslashes($article->title) }}",
    "alternativeHeadline": "{{ addslashes($article->description) }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{ request()->url() }}"
  },
  "image": [
    "{{ $article->image ? $article->image->url() : '' }}"
   ],
  "datePublished": "{{ $article->created_at }}",
  "dateModified": "{{ $article->updated_at }}",
  "author": {
    "@type": "Person",
    "name": "{{ $article->author->full_name ?? $article->user->full_name }}"
  },
   "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.organization') }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('storage/images/logo.png') }}"
    }
  },
  "description": "{{ addslashes($article->description) }}",
  "articleSection": "{{ $article->type->name }}"
}
</script>
