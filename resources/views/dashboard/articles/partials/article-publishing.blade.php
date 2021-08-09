<div class="d-flex mb-3 align-items-center justify-content-between">
    @if($article->visible)
        <button wire:click="suppress" wire:loading.attr="disabled" wire:target="suppress, save, photos" type="button" class="btn btn-warning btn-sm">
            <em wire:loading.remove wire:target="suppress" class="fa fa-volume-mute me-2" style="width: 16px; height: 14px"></em>
            <em wire:loading wire:target="suppress" class="fa fa-spin fa-spinner me-2" style="width: 16px; height: 14px"></em>
            <span>{{ __("Suppress") }}</span>
        </button>
    @else
        <button wire:click="publish" wire:loading.attr="disabled" wire:target="publish, save, photos" type="button" class="btn btn-success btn-sm">
            <em wire:loading.remove wire:target="publish" class="fa fa-volume-up me-2" style="width: 16px; height: 14px"></em>
            <em wire:loading wire:target="publish" class="fa fa-spin fa-spinner me-2" style="width: 16px; height: 14px"></em>
            <span>{{ __("Publish") }}</span>
        </button>
    @endif
</div>
