<?php

namespace Firebed\News\Models;

use Firebed\News\Models\Media\Traits\HasImages;
use Firebed\Permission\Models\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int    id
 * @property string first_name
 * @property string last_name
 * @property string email_name
 * @property string slug
 * @property bool   active
 * @property string password
 * @property mixed  cover_photo
 *
 * @method Builder active()
 *
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasImages, HasRoles, HasApiTokens;

    protected string $disk = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected array $collections = ['cover_photo'];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function latestArticle(): HasOne
    {
        return $this->hasOne(Article::class, 'author_id')->latest();
    }

    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    public function latestLogin(): HasOne
    {
        return $this->hasOne(Login::class)->latest();
    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('active', true);
    }

    public function cover_photo(): MorphOne
    {
        return $this->image('cover');
    }

    public function registerImageConversions(): void
    {
        $this->addImageConversion('sm', fn($image) => $this->fitOrResize($image, 245, 138));
        $this->addImageConversion('md', fn($image) => $this->fitOrResize($image, 416, 234));
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
