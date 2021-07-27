<?php


namespace Firebed\News\Livewire\Admin\Article\Traits;


use Livewire\Redirector;

trait DeletesArticle
{
    /**
     * @return Redirector
     */
    public function deleteArticle(): Redirector
    {
        $this->article->podcast()->delete();
        $this->article->delete();
        return redirect()->route('admin.articles.index');
    }
}
