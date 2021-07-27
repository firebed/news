<?php

namespace Firebed\News\Listeners;


use Firebed\News\Events\ArticleViewed;
use Firebed\News\Models\Article;

class IncrementArticleViews
{
    /**
     * Handle the event.
     *
     * @param ArticleViewed $event
     * @return void
     */
    public function handle(ArticleViewed $event): void
    {
        $article = $event->article;
        if (!$this->isArticleViewed($article)) {
            $article->timestamps = false;
            $article->increment('views');
            $article->timestamps = true;
            $this->storeArticle($article);
        }
    }

    private function isArticleViewed(Article $article): bool
    {
        $viewed_articles = session('viewed_articles', []);
        return in_array($article->id, $viewed_articles);
    }

    private function storeArticle(Article $article): void
    {
        session()->push('viewed_articles', $article->id);
    }
}
