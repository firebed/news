<?php

namespace Firebed\News\Controllers\User;

use Firebed\News\Events\ArticleViewed;
use Firebed\News\Models\Article;
use Firebed\News\Models\Tag;
use Firebed\News\Models\Type;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

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

        return view('user.articles.index', compact('type', 'articles'));
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

        return view('user.articles.show', compact('type', 'article'));
    }

    public function search(Request $request): Renderable
    {
        $articles = Article
            ::when($request->filled('q'), fn($q) => $q->matchAgainst($request->input('q')))
            ->latest()
            ->with('type', 'image')
            ->paginate(48);

        return view('user.articles.search', compact('articles'));
    }

    public function search_by_tag(Tag $tag): Renderable
    {
        $articles = Article
            ::whereHas('tags', fn($q) => $q->where('slug', $tag->slug))
            ->latest()
            ->with('type', 'image')
            ->paginate(48);

        return view('user.articles.search_by_tag', compact('tag', 'articles'));
    }

    public function all_news(): Renderable
    {
        $articles = Article
            ::visible()
            ->latest()
            ->with('type', 'image')
            ->paginate(48);

        return view('user.articles.all-news', compact('articles'));
    }

    public function redirect(Request $request): RedirectResponse
    {
        $article = Article::findOrFail($request->input('id'));
        return redirect()->route('user.articles.show', [$article->type->slug, $article->slug], 301);
    }

    public function image(Request $request): Redirector|Application|RedirectResponse
    {
        $id = $request->segment(3);
        $filename = $request->segment(4);
        return redirect('storage/images/articles/' . $id . '/' . $filename, 301);
    }

    public function thumbnail(Request $request): Redirector|Application|RedirectResponse
    {
        $id = $request->segment(3);
        $filename = $request->segment(5);
        return redirect('storage/images/articles/' . $id . '/' . $filename, 301);
    }
}
