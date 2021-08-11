<?php

namespace Firebed\News\Controllers\User;

use Firebed\News\Models\Article;
use Firebed\News\Models\Type;
use Firebed\News\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;

class AuthorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $type = Type::find(2);

        $authors = User
            ::role('Author')
            ->whereHas('articles', fn($q) => $q->visible()->where('type_id', $type->id))
            ->withCount(['articles' => fn($q) => $q->visible()->where('type_id', $type->id)])
            ->get()
            ->sortByDesc('articles_count');

        // Load 3 articles for each user
        $authors->each(fn($author) => $author->load(['articles' => fn($q) => $q->visible()->where('type_id', $type->id)->latest()->take(3)]));

        // Collect all articles and eagerly load the images
        Collection::make($authors->pluck('articles')->flatten())->load('image');

        return view('news::user.authors.index', compact('type', 'authors'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $author
     * @return Renderable
     */
    public function show(User $author): Renderable
    {
        if (!$author->hasRole('Author')) {
            abort(404);
        }

        $author->loadCount(['articles' => fn($q) => $q->visible()->where('type_id', 2)]);

        $articles = Article
            ::visible()
            ->where('author_id', $author->id)
            ->where('type_id', 2)
            ->with('type', 'image')
            ->latest()
            ->paginate(16);


        return view('news::user.authors.show', compact('author', 'articles'));
    }
}
