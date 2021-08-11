<?php

namespace Firebed\News\View\Components;

use Firebed\News\Models\Article;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class LatestNews extends Component
{
    public Collection $articles;
    public ?Article   $first;

    /**
     * Create a new component instance.
     *
     * @param Article $except
     * @param int     $take
     */
    public function __construct(Article $except, int $take = 10)
    {
        $this->articles = Article
            ::visible()
            ->whereKeyNot($except->id)
            ->limit($take)
            ->latest()
            ->with('type', 'image')
            ->get();

        $this->first = $this->articles->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Renderable
     */
    public function render(): Renderable
    {
        return view('news::user.articles.components.latest-news');
    }
}
