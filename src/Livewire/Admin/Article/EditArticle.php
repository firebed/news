<?php

namespace Firebed\News\Livewire\Admin\Article;

use Firebed\News\Livewire\Admin\Article\Traits\DeletesArticle;
use Firebed\News\Livewire\Admin\Article\Traits\ManagesArticle;
use Firebed\News\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditArticle extends Component
{
    use WithFileUploads, AuthorizesRequests, ManagesArticle, DeletesArticle;

    public $title = "";

    public function mount(Article $article): void
    {
        $this->article = $article;
        $this->title = $article->title;
        $this->tags = $article->tags()->get()->pluck('name')->toArray();
    }

    /**
     * @throws AuthorizationException
     */
    public function save(): void
    {
        $this->authorize('Update article');
        $this->validate();
        $this->saveArticle();
        $this->title = $this->article->title;
        $this->emitSelf('notify-saved');
    }

    public function getSizeOnDiskProperty(): string
    {
        return dir_size('articles', $this->article->id);
    }

    public function render()
    {
        $images = $this->article->images('photos')->get();

        return view('news::dashboard.articles.edit', compact('images'))
            ->layout('news::dashboard.layouts.app', ['title' => 'Edit article']);
    }
}
