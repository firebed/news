<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label for="title" class="form-label small text-secondary">{{ __("Title") }}</label>
            <input wire:model="article.title" type="text" id="title" class="form-control form-control-sm @error('article.title') is-invalid @enderror">
            @error('article.title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label small text-secondary">{{ __("Slug") }}</label>
            <input wire:model.defer="article.slug" type="text" id="slug" class="form-control form-control-sm @error('article.slug') is-invalid @enderror">
            @error('article.slug')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3" x-data="{ count: 0 }" x-init="count = $refs.input.value.length">
            <label for="description" class="form-label small text-secondary">{{ __("Description") }}</label>
            <x-input.textarea wire:model.defer="article.description" x-ref="input" x-on:keydown.enter="event.preventDefault()" x-on:keyup="count = $refs.input.value.length" error="article.description" rows="3" maxlength="160" id="description"/>
            <div class="form-text"><span x-html="count"></span>/<span x-html="$refs.input.maxLength"></span></div>
            @error('article.description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div wire:ignore>
            <label for="content" class="form-label small text-secondary">{{ __("Content") }}</label>
            <textarea wire:model.defer="article.content" x-data="tinyMCE()" x-init="init($dispatch)" id="content" rows="25" class="form-control form-control-sm"></textarea>
        </div>
        @error('article.content')
        <div class="text-danger mt-1 small">{{ $message }}</div>
        @enderror
    </div>
</div>
