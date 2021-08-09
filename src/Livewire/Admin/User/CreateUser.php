<?php

namespace Firebed\News\Livewire\Admin\User;

use Firebed\News\Livewire\Admin\User\Traits\ManagesUser;
use Firebed\News\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use AuthorizesRequests, WithFileUploads, ManagesUser;

    public function mount(): void
    {
        $this->user = new User();
        $this->user->active = TRUE;
    }

    public function save()
    {
        $this->authorize('Create user');

        $this->validate(array_merge($this->rules, ['password' => 'required|string']));
        $this->saveUser();

        return redirect()->route('admin.users.edit', $this->user);
    }

    public function render()
    {
        return view('news::dashboard.users.create')
            ->layout('news::dashboard.layouts.app', ['title' => __("Create user")]);
    }
}
