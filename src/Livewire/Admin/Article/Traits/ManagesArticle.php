<?php


namespace Firebed\News\Livewire\Admin\Article\Traits;


use Firebed\News\Livewire\Traits\TrimStrings;
use Firebed\News\Models\Article;
use Firebed\News\Models\Podcast;
use Firebed\News\Models\Type;
use Firebed\News\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait ManagesArticle
{
    use HasTags, HasPhotos, PublishesArticle, TrimStrings;

    public Article $article;
    public         $photo;
    public         $podcast = "";

    public int $refreshUploads = 0;

    protected function rules(): array
    {
        return [
//            'photo'               => 'nullable|image',
            'article.id'          => 'int',
            'article.title'       => 'required|string',
            'article.author_id'   => 'nullable|required_if:article.type_id,2|integer',
            'article.type_id'     => 'required|integer',
            'article.slug'        => 'required|string|regex:/^([a-z0-9]+-)*[a-z0-9]+$/i|unique:articles,slug,' . $this->article->id,
            'article.description' => 'nullable|string|max:160',
            'article.content'     => 'nullable|string',
            'article.visible'     => 'required|boolean',
            'article.show_images' => 'required|boolean'
        ];
    }

    public function mountManagesArticle(): void
    {
        $podcast = $this->article->podcast()->first();
        if ($podcast) {
            $this->podcast = $podcast->url;
        }
    }

    public function getTypesProperty(): Collection|array
    {
        return Type::orderBy('name')->get();
    }

    public function getAuthorsProperty()
    {
        return User::role('Author')->active()->orderByDesc('active')->orderBy('first_name')->orderBy('last_name')->get();
    }

    protected function saveArticle(): void
    {
        $this->article->description = $this->trim($this->article->description);
        $this->article->slug = trim($this->article->slug);
        $this->article->content = $this->trim($this->article->content);
        $this->article->save();

        $this->saveTags();

        if (!empty($this->photo)) {
            if ($this->article->image) {
                $this->article->image->delete();
            }
            $this->article->saveImage($this->photo);
            $this->article->load('image');
            $this->photo = NULL;
        }

        $podcast = $this->trim($this->podcast);
        if (filled($podcast)) {
            $this->article->podcast()->delete();
            $this->article->podcast()->save(new Podcast(['url' => $podcast]));
        } elseif ($this->article->podcast()->exists()) {
            $this->article->podcast()->delete();
        }

        $this->savePhotos();
    }
}
