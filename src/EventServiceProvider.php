<?php

namespace Firebed\News;

use Firebed\News\Events\ArticleViewed;
use Firebed\News\Listeners\IncrementArticleViews;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ArticleViewed::class => [
            IncrementArticleViews::class
        ]
    ];
}