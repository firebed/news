<?php

namespace Firebed\News\Models\Gate;

use Firebed\News\Models\Gate\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models\Gate
 *
 * @property int    id
 * @property string name
 *
 * @mixin Builder
 */
class Role extends Model
{
    use HasFactory, HasPermissions;
}
