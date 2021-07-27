<?php

namespace Firebed\News\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Login
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property Carbon  $created_at
 *
 * @mixin Builder
 */
class Login extends Model
{
    use HasFactory;

    protected array $fillable = ['user_id'];

    public bool $timestamps = false;

    protected array $casts = [
        'created_at' => 'datetime'
    ];
}
