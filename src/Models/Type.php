<?php

namespace Firebed\News\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Type
 * @package App\Models
 *
 * @property integer $id
 *
 * @mixin Builder
 */
class Type extends Model
{
    use HasFactory;

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function isColumn(): bool
    {
        return $this->id === 2;
    }

    public function isVideo(): bool
    {
        return $this->id === 12;
    }
}
