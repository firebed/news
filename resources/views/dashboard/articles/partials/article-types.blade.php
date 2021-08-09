<div class="card shadow-sm mb-4">
    <div class="card-header d-flex flex-column">
        <span class="fw-bold">{{ __("Article types") }} ({{ count($selected_types) }})</span>
        <small class="text-muted">
            {{ collect($selected_types)->map(fn($t) => $types->find($t)->name)->join(', ') }}
        </small>
    </div>
    <div class="card-body scrollbar" style="height: 200px">
        <div class="row row-cols-2">
            @foreach($types as $type)
                <div class="col" wire:key="type-{{ $type->id }}">
                    <x-input.checkbox wire:model="selected_types" value="{{ $type->id }}" id="type-{{ $type->id }}" wire:key="type-{{ $type->id }}">{{ $type->name }}</x-input.checkbox>
                </div>
            @endforeach
        </div>
    </div>
</div>
