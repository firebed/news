<div class="mt-4 card shadow-sm">
    <div class="card-body">
        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-article">{{ __("Delete article") }}</button>
    </div>
</div>

<x-news::modal title="{{ __('Delete article') }}" id="delete-article" submit="deleteArticle">
    <x-news::modal.header>{{ __("Delete article") }}</x-news::modal.header>
    <x-news::modal.body>
        <div class="row">
            <div class="col-10">{{ __("Are you sure you want to delete this article?") }}</div>
            <div class="col-2"><em class="far fa-trash-alt fa-4x text-secondary"></em></div>
        </div>
    </x-news::modal.body>
    <x-news::modal.footer>
        <x-news::modal.close-button class="w-5r"/>
        <x-news::button wire:click="deleteArticle" wire:loading.attr="disabled" wire:target="deleteArticle" class="btn-danger btn-sm w-5r">
            <em wire:loading wire:target="deleteArticle" class="fa fa-spinner fa-spin"></em> {{ __("Delete") }}
        </x-news::button>
    </x-news::modal.footer>
</x-news::modal>
