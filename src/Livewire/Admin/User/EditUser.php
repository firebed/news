<?php

namespace Firebed\News\Livewire\Admin\User;

use Firebed\News\Livewire\Admin\User\Traits\ManagesUser;
use Firebed\News\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use AuthorizesRequests, WithFileUploads, ManagesUser;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @throws AuthorizationException
     */
    public function save(): void
    {
        $this->authorize('Update user');

        $this->validate();
        $this->saveUser();
        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('news::dashboard.users.edit')
            ->layout('news::dashboard.layouts.app', ['title' => __("Edit user")]);
    }
}
