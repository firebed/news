<div class="row bg-white shadow-sm px-4 py-3 sticky-lg-top justify-content-center">
    <div class="col-12 col-xxl-10 d-flex justify-content-between align-content-center">
        <div class="fs-5">{{ $title }}</div>
        <div class="d-flex align-items-center">
            <span x-data="{ show: false }" x-init="@this.on('notify-saved', () => { setTimeout(() => show = false, 2500); show = true; })" x-show.transition.out.duration.1000ms="show" class="me-3 text-success" style="display: none">
                <em class="fa fa-check-circle"></em> {{ __("Saved") }}
            </span>
            <x-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="btn-primary btn-sm">
                <em wire:loading.remove wire:target="save" class="fa fa-save wpx-1"></em>
                <em wire:loading wire:target="save" class="fa fa-spinner wpx-1 fa-spin"></em>
                {{ __("Save") }}
            </x-button>
        </div>
    </div>
</div>
