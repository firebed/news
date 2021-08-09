<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="h5 mb-3">{{ __("Personal info") }}</div>
        <div class="row mb-3">
            <div class="col">
                <label for="first-name" class="form-label small text-secondary">{{ __("Name") }}</label>
                <x-news::input.text wire:model="user.first_name" id="first-name" error="user.first_name"/>
            </div>
            <div class="col">
                <label for="last-name" class="form-label small text-secondary">{{ __("Surname") }}</label>
                <x-news::input.text wire:model="user.last_name" id="first-name" error="user.last_name"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="title" class="form-label small text-secondary">{{ __("validation.attributes.title") }}</label>
                <x-news::input.text wire:model.defer="user.title" id="title" error="user.title"/>
            </div>
            <div class="col">
                <label for="slug" class="form-label small text-secondary">{{ __("Slug") }}</label>
                <x-news::input.text wire:model.defer="user.slug" id="slug" error="user.slug"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email" class="form-label small text-secondary">{{ __("Email") }}</label>
                <x-news::input.email wire:model.defer="user.email" id="email" error="user.email"/>
            </div>
            <div class="col">
                <label for="password" class="form-label small text-secondary">{{ __("Password") }}</label>
                <x-news::input.text wire:model.defer="password" id="password" error="password"/>
            </div>
        </div>
    </div>
</div>
