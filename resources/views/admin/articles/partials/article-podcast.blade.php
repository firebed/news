<div class="card shadow-sm mb-4">
    <div class="card-header fw-bold">{{ __("Podcast") }}</div>
    <div class="card-body">
        <label for="podcast" class="form-label">{{ __("URL") }}</label>
        <x-input.text wire:model="podcast" id="podcast" />
    </div>
</div>
