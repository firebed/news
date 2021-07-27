<?php

namespace Firebed\News\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Podcast
 * @package App\Models
 *
 * @property string url
 *
 * @mixin Builder
 */
class Podcast extends Model
{
    use HasFactory;

    protected array $fillable = ['url'];

    public function recordable(): MorphTo
    {
        return $this->morphTo();
    }
}
