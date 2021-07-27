<div class="mt-4 card shadow-sm">
    <div class="card-body">
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-article">{{ __("Delete article") }}</button>
    </div>
</div>

<x-modal title="{{ __('Delete article') }}" id="delete-article" submit="deleteArticle">
    <x-modal.header>{{ __("Delete article") }}</x-modal.header>
    <x-modal.body>
        <div class="row">
            <div class="col-10">{{ __("Are you sure you want to delete this article?") }}</div>
            <div class="col-2"><em class="far fa-trash-alt fa-4x text-secondary"></em></div>
        </div>
    </x-modal.body>
    <x-modal.footer>
        <x-modal.close-button class="wpx-5"/>
        <x-button wire:click="deleteArticle" wire:loading.attr="disabled" wire:target="deleteArticle" class="btn-danger btn-sm wpx-5">
            <em wire:loading wire:target="deleteArticle" class="fa fa-spinner fa-spin"></em> {{ __("Delete") }}
        </x-button>
    </x-modal.footer>
</x-modal>
