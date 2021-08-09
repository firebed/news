<?php

namespace Firebed\News\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 *
 * @property string slug
 *
 * @mixin Builder
 */
class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;
}
