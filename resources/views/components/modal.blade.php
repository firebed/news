<div wire:ignore.self class="modal fade" {{ $attributes }} tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog shadow">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
