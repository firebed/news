<?php


namespace Firebed\News\Livewire\Admin\Article\Traits;


use Firebed\News\Models\Tag;
use Firebed\News\Services\SlugGenerator;

trait HasTags
{
    public array  $tags = [];
    public string $tag  = "";

    public function addTag(): void
    {
        $tag = trim($this->tag);
        if (!empty($tag) && !in_array($tag, $this->tags, true)) {
            $this->tags[] = $tag;
            $this->tag = "";
        }
    }

    public function removeTag($tag): void
    {
        if (($key = array_search($tag, $this->tags, true)) !== false) {
            unset($this->tags[$key]);
        }
        $this->tags = array_values($this->tags);
    }

    protected function saveTags(): void
    {
        if (!empty($this->tags)) {
            $this->article->tags()->delete();
            Tag::insert(collect($this->tags)->map(fn($t) => [
                'article_id' => $this->article->id,
                'name' => $t,
                'slug' => SlugGenerator::getSlug($t)
            ])->all());
        }
    }
}
