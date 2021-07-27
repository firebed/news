<div class="mt-3 border rounded shadow-sm" style="background-color: #f1f0ef">
    @can("Upload photo")
        <div class="p-3 pb-0">
            <x-input.switch wire:model="article.show_images" id="show-images">{{ __("Show images on website") }}</x-input.switch>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <input hidden type="file" id="photos" multiple accept="image/*"/>
            <label for="photos" class="d-block w-100 p-3 btn btn-link text-decoration-none text-secondary">{{ __("Drag & Drop your files or") }} <span class="text-decoration-underline">{{ __("Browse") }}</span></label>
        </div>
    @endcan
    <div wire:ignore wire:key="{{ $refreshUploads }}" id="images-preview" class="row row-cols-4 g-2 px-3 mb-3">
        @isset($images)
            @foreach($images as $image)
                <div class="col">
                    <div class="ratio ratio-16x9 rounded-3 border">
                        <img src="{{ $image->url('sm') }}" alt="" class="rounded-3 top-50 start-50 translate-middle w-auto h-auto mw-100 mh-100">
                        <div class="px-2 pt-2 pb-4 w-100 h-auto rounded-top d-flex justify-content-between align-items-center">
                            <span></span>
                            <div wire:click="deletePhoto({{ $image->id }})" class="rounded rounded-circle d-flex justify-content-center align-items-center p-1" style="background-color: rgba(0,0,0,.5); width: 26px; height: 26px">
                                <em class="fa fa-times text-light"></em>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
    </div>
</div>
