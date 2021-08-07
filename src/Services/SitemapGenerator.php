<?php

namespace Firebed\News\Services;

use Firebed\News\Models\Article;
use Firebed\News\Models\Type;
use Firebed\News\Models\User;
use Firebed\Sitemap\Sitemap;
use Firebed\Sitemap\SitemapIndex;
use Firebed\Sitemap\Url;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL as BaseURL;

class SitemapGenerator
{
    public int $total_sitemaps = 0;
    public int $total_urls     = 0;

    public function generate(): void
    {
        $this->increaseMemoryLimit();

        $pages = $this->handlePages();
        $this->writeSitemap($pages, 'sitemaps/pages.xml');

        $authors = $this->handleAuthors();
        $this->writeSitemap($authors, 'sitemaps/authors.xml');

        $types = $this->handleTypes();
        $this->writeSitemap($types, 'sitemaps/types.xml');

        $articles = $this->handleArticles();
        foreach ($articles as $i => $article) {
            $this->writeSitemap($article['loc'], "sitemaps/articles-" . ($i + 1) . ".xml");
        }

        $index = (new SitemapIndex())
            ->addSitemapIf($pages !== NULL, fn() => [BaseURL::asset('sitemaps/pages.xml'), now()])
            ->addSitemapIf($authors !== NULL, fn() => [BaseURL::asset('sitemaps/authors.xml'), now()])
            ->addSitemapIf($types !== NULL, fn() => [BaseURL::asset('sitemaps/types.xml'), now()]);

        foreach ($articles as $i => $article) {
            $index->addSitemap(BaseURL::asset("sitemaps/articles-" . ($i + 1) . ".xml"), $article['lastmod']);
        }

        if (!$index->isEmpty()) {
            $index->writeToDisk('public', 'sitemap.xml');
        }
    }

    private function increaseMemoryLimit(): void
    {
        ini_set('memory_limit', "1G");
    }

    private function handlePages(): Sitemap|null
    {
        $sitemap = new Sitemap();
        $sitemap->addUrl(route('user.homepage'), now(), Url::CHANGE_FREQ_DAILY, 1);
        $sitemap->addUrl(route('user.articles.all_news'), now(), Url::CHANGE_FREQ_DAILY, 1);
        $sitemap->addUrl(route('user.authors.index'), now(), Url::CHANGE_FREQ_WEEKLY, .9);
        $sitemap->addUrl(route('user.contact.index'), now(), Url::CHANGE_FREQ_MONTHLY, .8);
        return $sitemap;
    }

    private function writeSitemap(Sitemap|null $sitemap, string $path): void
    {
        if ($sitemap === NULL) {
            return;
        }

        $sitemap?->writeToDisk('public', $path);
        $this->total_urls += $sitemap->totalUrls();
        ++$this->total_sitemaps;
    }

    private function handleAuthors(): null|Sitemap
    {
        $authors = User
            ::role('Author')
            ->whereHas('articles', fn($q) => $q->visible()->where('type_id', 2))
            ->get();

        if ($authors->isEmpty()) {
            return NULL;
        }

        $sitemap = new Sitemap();
        foreach ($authors as $author) {
            $sitemap->addUrl(route('user.authors.show', $author->slug), now(), Url::CHANGE_FREQ_WEEKLY);
        }

        return $sitemap;
    }

    private function handleTypes(): Sitemap|null
    {
        $types = Type::all();
        if ($types->isEmpty()) {
            return NULL;
        }

        $sitemap = new Sitemap();
        foreach ($types as $type) {
            $sitemap->addUrl(route('user.articles.index', $type->slug), now(), Url::CHANGE_FREQ_DAILY);
        }
        return $sitemap;
    }

    private function handleArticles(): array
    {
        $articles = Article::visible()->with('type', 'image')->oldest('updated_at')->get();
        if ($articles->isEmpty()) {
            return [];
        }

        $sitemaps = [];
        $chunks = $articles->chunk(1000);
        foreach ($chunks as $articles) {
            $sitemap = new Sitemap();

            foreach ($articles as $article) {
                $url = new Url();
                $url->lastmod = $article->updated_at;
                $url->changefreq = Url::CHANGE_FREQ_MONTHLY;

                $url->loc = route('user.articles.show', [$article->type->slug, $article->slug]);

                if ($article->image) {
                    $url->addImage($article->image->url(), $article->title);
                }

                $sitemap->addUrl($url);
            }

            $sitemaps[] = ['sitemap' => $sitemap, 'lastmod' => $articles->last()->updated_at];
        }

        return $sitemaps;
    }

    public function shouldUpdate(): bool
    {
        if (!$this->getDisk()->exists('sitemap.xml')) {
            return TRUE;
        }

        $lastmod = Carbon::createFromTimestamp($this->getDisk()->lastModified('sitemap.xml'));

        $product = Article::latest('updated_at')->first();
        if ($product?->updated_at->gt($lastmod)) {
            return TRUE;
        }

        return FALSE;
    }

    private function getDisk(): Filesystem
    {
        return Storage::disk('public');
    }
}