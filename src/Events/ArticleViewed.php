<?php

namespace Firebed\News\Events;

use Firebed\News\Models\Article;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }
}
