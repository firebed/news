<?php

namespace Firebed\News\Livewire\Admin\Article;

use Firebed\News\Models\Article;
use Firebed\News\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class ShowArticles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'id'            => ['except' => ''],
        'search'        => ['except' => ''],
        'selected_type' => ['except' => ''],
        'sortField'     => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc']
    ];

    public $article_id;
    public $search;
    public $selected_type;
    public $sortField     = 'created_at';
    public $sortDirection = 'desc';

    public function updated(): void
    {
        $this->resetPage();
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $types = Type::withCount('articles')->orderBy('name')->get();
        $articles = Article
            ::when(!empty($this->article_id), fn($q) => $q->whereKey($this->article_id))
            ->when(!empty($this->selected_type), fn($q) => $q->where('type_id', $this->selected_type))
            ->when(!empty($this->search), fn($q) => $q->matchAgainst($this->search))
            ->with('type', 'image', 'user')
            ->orderBy($this->sortField, $this->sortDirection)
            ->simplePaginate();

        return view('news::dashboard.articles.index', compact('types', 'articles'))
            ->layout('news::dashboard.layouts.app', ['title' => __("All articles")]);
    }
}
