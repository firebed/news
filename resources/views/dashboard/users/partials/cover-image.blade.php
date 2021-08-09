<div class="card shadow-sm">
    <div class="card-body">
        <div class="h5 mb-3">{{ __("Cover image") }}</div>

        <div class="d-flex flex-column align-items-center">
            @if($cover_photo)
                <div class="ratio ratio-16x9 rounded">
                    <img src="{{ $cover_photo->temporaryUrl() }}" alt="" class="img-auto start-50 top-50 translate-middle rounded"/>
                </div>
            @elseif($user->cover_photo)
                <div class="ratio ratio-16x9 rounded">
                    <img src="{{ $user->cover_photo->url('md') }}" alt="" class="img-auto start-50 top-50 translate-middle rounded"/>
                </div>
            @else
                <em class="fa fa-camera fa-7x text-gray-300"></em>
            @endif
            @can('Upload photo')
                <div class="mt-3">
                    <x-news::input.file wire:model="cover_photo" hidden id="cover-photo"/>
                    <label wire:loading.class="disabled" wire:target="cover_photo" for="cover-photo" class="btn btn-sm btn-secondary">
                        <x-news::icons.upload wire:loading.remove="" wire:target="cover_photo"></x-news::icons.upload>
                        <x-news::icons.spinner wire:loading wire:target="cover_photo"></x-news::icons.spinner>
                        {{ __("Upload") }}
                    </label>
                </div>
            @endcan
        </div>
    </div>
</div>
