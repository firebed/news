<div class="card shadow-sm">
    <div class="card-body">

        <div class="h5 mb-3">{{ __("Roles and Permissions") }}</div>

        <div class="row row-cols-3">
            @foreach($this->roles as $role)
                <div class="col d-flex flex-column" wire:key="role-{{ $role->id }}">
                    <div class="fw-bold border-bottom pb-2 mb-2">
                        <x-news::input.checkbox
                            wire:model="selected_roles"
                            value="{{ $role->id }}"
                            id="role-{{ $role->id }}">
                            {{ __($role->name) }}
                        </x-news::input.checkbox>
                    </div>
                    @foreach($role->permissions as $permission)
                        <x-news::input.checkbox
                            wire:model.defer="selected_permissions"
                            wire:key="permission-{{ $permission->id}}"
                            value="{{ $permission->id }}"
                            id="permission-{{ $permission->id }}">
                            {{ __($permission->name) }}
                        </x-news::input.checkbox>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
