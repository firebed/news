<?php


namespace Firebed\News\Livewire\Admin\User\Traits;


trait HasPhotos
{
    public $profile_photo;
    public $cover_photo;

    /**
     * @param $key
     */
    public function updating($key): void
    {
        if (in_array($key, ['profile_photo', 'cover_photo'])) {
            $this->authorize('Upload photo');
        } else if ($key === 'selected_permissions') {
            $this->authorize('Manage permissions');
        }
    }

    protected function savePhotos(): void
    {
        if (!empty($this->profile_photo)) {
            if ($this->user->image) {
                $this->user->image->delete();
            }

            $this->user->saveImage($this->profile_photo);
        }

        if (!empty($this->cover_photo)) {
            if ($this->user->cover_photo) {
                $this->user->cover_photo->delete();
            }

            $this->user->saveImage($this->cover_photo, 'cover');
        }
    }
}
