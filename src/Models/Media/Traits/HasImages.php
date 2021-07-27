<?php

namespace Firebed\News\Models\Media\Traits;

use Firebed\News\Models\Media\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

/**
 * Trait HasImages
 * @package App\Models\Media\Traits
 *
 * @property Image image
 */
trait HasImages
{
    protected bool $userIdAsPrefix = TRUE;
    private array  $conversions    = [];

    public static function bootHasImages(): void
    {
        static::deleting(function ($model) {
            Storage::disk($model->getMediaDisk())->deleteDirectory($model->getPathPrefix());
        });
    }

    public function image(?string $collection = NULL): MorphOne
    {
        if (is_null($collection)) {
            return $this->morphOne(Image::class, 'imageable')->whereNull('collection');
        }

        return $this->morphOne(Image::class, 'imageable')->where('collection', $collection);
    }

    public function images(?string $collection = NULL): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable')->when($collection, fn($q) => $q->where('collection', $collection));
    }

    public function saveImage($file, ?string $collection = NULL): Image
    {
        $manager = new ImageManager();
        $image = $manager->make($file);

        if ($file instanceof UploadedFile) {
            $hashName = $file->hashName();
        } else {
            $mime = $image->mime();
            $hashName = Str::random(40) . '.' . substr($mime, strrpos($mime, '/') + 1);
        }

        $path = $this->path($hashName);
        $this->resizeBaseImage($image);
        $this->saveToDisk($path, $image, 80);

        if (method_exists($this, 'registerImageConversions')) {
            $this->registerImageConversions();
        }

        $media = new Image([
            'disk'        => $this->getMediaDisk(),
            'collection'  => $collection,
            'src'         => $path,
            'width'       => $image->getWidth(),
            'height'      => $image->getHeight(),
            'size'        => $image->filesize(),
            'conversions' => $this->prepareConversions($hashName, $manager, $file)
        ]);
        $this->images()->save($media);
        return $media;
    }

    protected function resizeBaseImage($image): void
    {
        //
    }

    private function saveToDisk($path, $image, $quality): void
    {
        Storage::disk($this->getMediaDisk())->put($path, $image->encode(null, $quality));
    }

    private function prepareConversions($hashName, $manager, $file): array
    {
        if (method_exists($this, 'registerImageConversions')) {
            $this->registerImageConversions();
        }

        $conversions = $media->conversions ?? [];
        foreach ($this->conversions as $name => $callback) {
            $image = $manager->make($file);
            $callback($image);

            $path = $this->path($name . '-' . $hashName);
            $this->saveToDisk($path, $image, 80);
            $conversions[$name] = [
                'src'    => $path,
                'width'  => $image->getWidth(),
                'height' => $image->getHeight(),
                'size'   => $image->filesize()
            ];
        }
        return $conversions;
    }

    public function getMediaDisk(): string
    {
        return $this->disk;
    }

    public function addImageConversion($name, callable $func): void
    {
        $this->conversions[$name] = $func;
    }

    protected function getPathPrefix(): string
    {
        return ($this->userIdAsPrefix ? $this->id . '/' : '');
    }

    protected function path($filename): string
    {
        return $this->getPathPrefix() . $filename;
    }

    public function isCollectionAttribute($key): bool
    {
        return in_array($key, $this->collections ?? []);
    }
}
