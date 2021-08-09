<?php

namespace Firebed\News\Controllers\Dashboard;

use Firebed\News\Controllers\Controller;
use Firebed\News\Models\Article;
use Firebed\News\Models\Type;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $types = Type::withCount('articles')->orderBy('name')->get();
        $articles = Article
            ::when(!empty($this->article_id), fn($q) => $q->whereKey($this->article_id))
            ->when(!empty($this->selected_type), fn($q) => $q->where('type_id', $this->selected_type))
            ->when(!empty($this->search), fn($q) => $q->matchAgainst($this->search))
            ->with('type', 'image', 'user')
//            ->orderBy($request->sortField, $request->sortDirection ?? 'asc')
            ->simplePaginate();

        return $this->view('dashboard.articles.index', [
            'types' => $types,
            'articles' => $articles
        ]);
    }
}