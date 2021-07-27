<?php


namespace Firebed\News\Livewire\Admin\Article\Traits;


use Firebed\News\Models\Article;

trait PublishesArticle
{
    public function publish(): void
    {
        $this->article->visible = TRUE;
        if ($this->article->id) {
            Article::whereKey($this->article->id)->update(['visible' => TRUE]);
        }
    }

    public function suppress(): void
    {
        $this->article->visible = FALSE;
        if ($this->article->id) {
            Article::whereKey($this->article->id)->update(['visible' => FALSE]);
        }
    }
}
