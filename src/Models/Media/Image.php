<?php

namespace Firebed\News\Models\Media;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $disk
 * @property string $collection
 * @property string $src
 * @property float  $width
 * @property float  $height
 * @property float  $size
 * @property array  conversions
 *
 * @mixin Builder
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = ['disk', 'collection', 'src', 'width', 'height', 'size', 'conversions'];

    protected $casts = [
        'conversions' => 'array'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function url($conversion = null): string
    {
        $src = $this->src;
        if ($this->isAbsolute()) {
            return $src;
        }

        if ($conversion !== NULL && $this->hasConversion($conversion)) {
            $src = $this->conversion($conversion)['src'];
        }
        return Storage::disk($this->disk)->url($src);
    }

    private function isAbsolute(): bool
    {
        return str_contains($this->src, '://');
    }

    public function conversion($name)
    {
        return $this->conversions[$name];
    }

    public function hasConversion($key): bool
    {
        return $this->conversions !== NULL && array_key_exists($key, $this->conversions);
    }

    protected static function booted(): void
    {
        static::deleted(function (Image $image) {
            if ($image->isAbsolute()) {
                return;
            }

            if (!method_exists($image, 'isForceDeleting') || $image->isForceDeleting()) {
                Storage::disk($image->disk)->delete($image->src);

                if ($image->conversions) {
                    foreach ($image->conversions as $conversion) {
                        Storage::disk($image->disk)->delete($conversion['src']);
                    }
                }
            }
        });
    }
}
