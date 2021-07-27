<?php

namespace Firebed\News\Models\Gate;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @property int    id
 * @property string name
 * @property string group_name
 *
 * @package App\Models\Gate
 *
 * @mixin Builder
 */
class Permission extends Model
{
    use HasFactory;
}
