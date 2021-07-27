<?php

namespace App\View\Components;

use Firebed\News\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SimilarNews extends Component
{
    public Collection $articles;

    /**
     * Create a new component instance.
     *
     * @param Article $except
     * @param int     $take
     */
    public function __construct(Article $except, int $take = 9)
    {
        $this->articles = Article
            ::visible()
            ->whereKeyNot($except->id)
            ->whereHas('tags', fn($q) => $q->whereIn('slug', $except->tags->pluck('slug')), '>=', 2)
            ->limit($take)
            ->latest()
            ->with('type', 'image')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('user.articles.components.similar-news');
    }
}
