<?php

namespace Firebed\News\Controllers\User;

use Exception;
use Firebed\News\Controllers\Controller;
use Firebed\News\Events\ArticleViewed;
use Firebed\News\Models\Article;
use Firebed\News\Models\Tag;
use Firebed\News\Models\Type;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Type $type
     * @return Renderable
     */
    public function index(Type $type): Renderable
    {
        $articles = Article
            ::visible()
            ->where('type_id', $type->id)
            ->with('image')
            ->latest()
            ->paginate(16);

        return $this->view('user.articles.index', compact('type', 'articles'));
    }

    public function show(Type $type, Article $article): Factory|View|Application
    {
        if (!$article->visible) {
            abort(404);
        }

        event(new ArticleViewed($article));

        foreach ($article->tags as $tag) {
            $regex = "/(" . str_replace('/', '\\/', addslashes($tag->name)) . "(?!([^<]+)?>))/i";
            try {
                $article->content = preg_replace($regex, '<a class="text-decoration-none" href="' . route('user.articles.search_by_tag', $tag->slug) . '">$1</a>', $article->content);
            } catch (Exception) {
            }
        }

        return $this->view('user.articles.show', compact('type', 'article'));
    }

    public function search(Request $request): Renderable
    {
        $articles = Article
            ::when($request->filled('q'), fn($q) => $q->matchAgainst($request->input('q')))
            ->latest()
            ->with('type', 'image')
            ->paginate(48);

        return $this->view('user.articles.search', compact('articles'));
    }

    public function search_by_tag(Tag $tag): Renderable
    {
        $articles = Article
            ::whereHas('tags', fn($q) => $q->where('slug', $tag->slug))
            ->latest()
            ->with('type', 'image')
            ->paginate(48);

        return $this->view('user.articles.search_by_tag', compact('tag', 'articles'));
    }

    public function all_news(): Renderable
    {
        $articles = Article
            ::visible()
            ->latest()
            ->with('type', 'image')
            ->paginate(48);

        return $this->view('user.articles.all-news', compact('articles'));
    }
}
