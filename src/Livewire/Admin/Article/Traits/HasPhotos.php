<?php


namespace Firebed\News\Livewire\Admin\Article\Traits;


use Firebed\News\Models\Media\Image;
use Exception;

trait HasPhotos
{
    public $photos = [];

    /**
     * @param Image $image
     * @throws Exception
     */
    public function deletePhoto(Image $image): void
    {
        $image->delete();
        $this->refreshUploads++;
    }

    public function savePhotos(): void
    {
        if (!empty($this->photos)) {
            foreach ($this->photos as $key => $photo) {
                $this->article->saveImage($photo, 'photos');
            }

            $this->photos = [];
            $this->refreshUploads++;
        }
    }
}
