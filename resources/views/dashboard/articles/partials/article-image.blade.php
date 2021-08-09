<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="ratio ratio-16x9 rounded">
            @if(isset($photo) || isset($article->image))
                <img src="{{ isset($photo) ? $photo->temporaryURL() : $article->image->url() }}" alt="{{ $article->title }}" class="img-auto start-50 top-50 translate-middle rounded">
            @endif
            <div wire:loading wire:target="photo" class="top-50 start-50 translate-middle w-auto h-auto rounded px-3 p-2" style="background-color: rgba(0,0,0,.6);">
                <em class="fa fa-spinner fa-spin text-light"></em>
            </div>
        </div>
        @can("Upload photo")
            <div class="mt-2">
                <input wire:model="photo" type="file" hidden id="photo" accept="image/*">
                <label for="photo" class="btn btn-sm btn-secondary" wire:loading.class="disabled" wire:model="photo">{{ __("Change photo") }}</label>
            </div>
        @endcan
    </div>
</div>
