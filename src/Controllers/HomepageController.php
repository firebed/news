<?php

namespace Firebed\News\Controllers;

use Firebed\News\Models\Article;
use Firebed\News\Models\Type;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;

class HomepageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return Renderable
     */
    public function __invoke(): Renderable
    {
        $ids = [6, 12, 8, 9, 7, 10, 16, 11, 17, 3, 18, 13, 14, 1, 4, 15, 5];
        $types = Type
            ::wherekey($ids)
            ->orderByRaw('FIELD(id,' . implode(', ', $ids) . ')')
            ->get();

        foreach ($types as $type) {
            $type->load(['articles' => fn($q) => $q->visible()->latest()->take(4)]);
        }
        $collection = Collection::make($types->pluck('articles')->flatten());
        $collection->load('image');

        $footer_types = $types->splice($types->count() - 4, 4);
        $footer_types->each(fn($t) => $t->articles->pop()); # Remove last item of each type

        $podcasts = $this->getPodcasts();
        $podcasts->pop();
        return view('news::user.homepage.index', [
            'gallery_news'   => $this->getGalleryNews(),
            'greek_articles' => $types->shift(),
            'columns'        => $this->getColumns(),
            'podcasts'       => $podcasts,
            'types'          => $types,
            'footer_types'   => $footer_types
        ]);
    }

    private function getGalleryNews(): Collection
    {
        return Article
            ::visible()
            ->limit(15)
            ->latest()
            ->with('type', 'image')
            ->get();
    }

    private function getColumns(): Collection
    {
        $authors = [2, 1, 14, 4, 5, 17];

        $latest_article = Article
            ::selectRaw("`author_id`, MAX(`created_at`) as `latest`")
            ->visible()
            ->whereIn('author_id', $authors)
            ->where('type_id', 2)
            ->groupBy('author_id');

        return Article
            ::selectRaw('articles.*')
            ->fromRaw("articles, (" . $latest_article->toSql() . ') as `latest_article`')
            ->mergeBindings($latest_article->getQuery())
            ->whereRaw('articles.author_id = latest_article.author_id')
            ->whereRaw('articles.created_at = latest_article.latest')
            ->orderByRaw('FIELD(articles.author_id,' . implode(', ', $authors) . ')')
            ->with('type', 'image')
            ->get();
    }

    private function getPodcasts(): Collection
    {
        return Article
            ::visible()
            ->whereHas('podcast')
            ->limit(4)
            ->latest()
            ->with('type', 'image')
            ->get();
    }
}
