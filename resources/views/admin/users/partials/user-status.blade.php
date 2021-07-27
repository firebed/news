<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="h5 mb-3">{{ __("User status") }}</div>
        <div class="text-secondary mb-3">
            <em class="fa fa-info-circle"></em> {{ __("Inactive users cannot access given permissions") }}
        </div>
        <x-input.select wire:model.defer="user.active" id="user-status" error="user.active">
            <option value="1">{{ __("Active") }}</option>
            <option value="0">{{ __("Inactive") }}</option>
        </x-input.select>
    </div>
</div>
