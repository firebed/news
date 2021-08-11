<?php

namespace Firebed\News\View\Components;

use Firebed\News\Models\Article;
use Firebed\News\Models\Type;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class LatestColumns extends Component
{
    public Collection $articles;
    public Type       $type;
    public ?Article   $first;
    public            $author;

    /**
     * Create a new component instance.
     *
     * @param Article $except
     * @param int     $take
     */
    public function __construct(Article $except, int $take = 10)
    {
        $this->type = Type::find(2);
        $this->author = $except->author;

        $this->articles = Article
            ::visible()
            ->where('type_id', 2)
            ->where('author_id', $this->author->id)
            ->whereKeyNot($except->id)
            ->limit($take)
            ->latest()
            ->with('image')
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
        return view('news::user.articles.components.latest-columns');
    }
}
