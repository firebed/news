<div class="row bg-white shadow-sm px-4 py-3 sticky-lg-top justify-content-center">
    <div class="col-12 col-xxl-10 d-flex justify-content-between align-content-center">
        <div class="fs-5">{{ $title }}</div>
        <div class="d-flex align-items-center">
            <span x-data="{ show: false }" x-init="@this.on('notify-saved', () => { setTimeout(() => show = false, 2500); show = true; })" x-show.transition.out.duration.1000ms="show" class="me-3 text-success" style="display: none">
                <em class="fa fa-check-circle"></em> {{ __("Saved") }}
            </span>
            <button wire:click="save" wire:loading.attr="disabled" wire:target="save, photos" type="button" class="btn btn-primary btn-sm">
                <em wire:loading.remove wire:target="save" class="fa fa-save me-2" style="width: 16px; height: 14px"></em>
                <em wire:loading wire:target="save" class="fa fa-spinner fa-spin me-2" style="width: 16px; height: 14px"></em>
                <span>{{ __("Save") }}</span>
            </button>
        </div>
    </div>
</div>
