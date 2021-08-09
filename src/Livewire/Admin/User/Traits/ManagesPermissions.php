<?php


namespace Firebed\News\Livewire\Admin\User\Traits;


use Firebed\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;

trait ManagesPermissions
{
    public array $selected_roles       = [];
    public array $selected_permissions = [];

    public function mountManagesPermissions(): void
    {
        $this->selected_roles = $this->user->roles()->get()->pluck('id')->map(fn($p) => (string)$p)->all();
        $this->selected_permissions = $this->user->permissions()->get()->pluck('id')->map(fn($p) => (string)$p)->all();
    }

    public function getRolesProperty(): Collection|array
    {
        return Role::with('permissions')->whereKeyNot(1)->get();
    }

    protected function savePermissions(): void
    {
        $this->user->syncRoles($this->selected_roles);
        $this->user->syncPermissions($this->selected_permissions);

        if (auth()->user()->is($this->user)) {
            auth()->user()->load('roles', 'permissions');
            $this->emit('permissions-updated');
        }
    }
}
