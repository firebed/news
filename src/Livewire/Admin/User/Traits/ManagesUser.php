<?php


namespace Firebed\News\Livewire\Admin\User\Traits;


use Firebed\News\Models\User;
use Illuminate\Support\Facades\Hash;

trait ManagesUser
{
    use HasPhotos, ManagesPermissions;

    public User   $user;
    public string $password = "";

    protected $rules = [
        'user.id'         => 'nullable|integer',
        'user.first_name' => 'required|string',
        'user.last_name'  => 'required|string',
        'user.title'      => 'nullable|string',
        'user.slug'       => 'required|string',
        'user.email'      => 'required|email',
        'user.active'     => 'required|boolean'
    ];

    public function updated($key): void
    {
        if (in_array($key, ['user.first_name', 'user.last_name'])) {
            $this->user->slug = slugify([$this->user->first_name, $this->user->last_name]);
        }
    }

    protected function saveUser(): void
    {
        if (!empty($this->password)) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->save();
        $this->savePhotos();
        $this->savePermissions();
    }
}
