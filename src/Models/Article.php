<?php

namespace Firebed\News\Models;

use Firebed\News\Models\Media\Traits\HasImages;
use Firebed\News\Models\Traits\FullTextIndex;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;
use Intervention\Image\Image;

/**
 * Class News
 * @package App\Models
 *
 * @property integer    id
 * @property integer    user_id
 * @property integer    author_id
 * @property integer    type_id
 * @property string     title
 * @property string     slug
 * @property string     content
 * @property bool       visible
 *
 * @property ?User      author
 * @property User       user
 * @property Collection tags
 * @property Collection photos
 * @property Type       type
 *
 * @method Builder visible()
 *
 * @mixin Builder
 */
class Article extends Model
{
    use HasFactory, HasImages, FullTextIndex;

    protected array $match = ['title', 'content'];

    protected string $disk        = 'articles';
    protected array  $collections = ['photos'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function podcast(): MorphOne
    {
        return $this->morphOne(Podcast::class, 'recordable');
    }

    public function isVisible(): bool
    {
        return $this->visible === TRUE;
    }

    public function scopeVisible(Builder $builder): Builder
    {
        return $builder->where('visible', TRUE);
    }

    public function getCoverPhotoAttribute(): ?string
    {
        return $this->type->isColumn()
            ? optional($this->author->cover_photo)->url()
            : optional($this->image)->url();
    }

    public function photos(): MorphMany
    {
        return $this->images('photos');
    }

    public function resizeBaseImage($image): void
    {
        $this->fitOrResize($image, 856, 481);
    }

    public function registerImageConversions(): void
    {
        $this->addImageConversion('sm', fn(Image $image) => $this->fitOrResize($image, 245, 138));
        $this->addImageConversion('md', fn(Image $image) => $this->fitOrResize($image, 416, 234));
    }

    private function fitOrResize($image, $width, $height): void
    {
        $aspectRatio = $image->width() / $image->height();
        if ($aspectRatio > 1) {
            $image->fit($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } else {
            $image->resize($width, NULL, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
    }
}
