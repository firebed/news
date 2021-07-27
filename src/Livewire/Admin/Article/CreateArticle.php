<?php

namespace Firebed\News\Livewire\Admin\Article;

use Firebed\News\Livewire\Admin\Article\Traits\ManagesArticle;
use Firebed\News\Models\Article;
use Firebed\News\Services\SlugGenerator;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;

class CreateArticle extends Component
{
    use WithFileUploads, AuthorizesRequests, ManagesArticle;

    public function mount(): void
    {
        $this->article = new Article;
        $this->article->show_images = TRUE;
    }

    public function updatedArticleTitle(): void
    {
        $this->article->slug = SlugGenerator::getSlug($this->article->title);
    }

    /**
     * @return Redirector
     * @throws AuthorizationException
     */
    public function save(): Redirector
    {
        $this->authorize('Create article');

        $this->article->user()->associate(user());
        $this->article->visible = FALSE;
        $this->validate();
        $this->saveArticle();

        return redirect()->route('admin.articles.edit', $this->article);
    }

    public function getSizeOnDiskProperty(): string
    {
        return 0;
    }

    public function render()
    {
        return view('admin.articles.create')
            ->layout('admin.layouts.app', ['title' => 'Create article']);
    }
}
