<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="h5 mb-3">{{ __("Profile image") }}</div>

        <div class="d-flex flex-column align-items-center">
            @if($profile_photo)
                <x-avatar size="128" class="bg-white" url="{{ $profile_photo->temporaryUrl() }}"/>
            @elseif($user->image)
                <x-avatar size="128" class="bg-white" url="{{ $user->image->url() }}"/>
            @else
                <em class="fa fa-camera fa-7x text-gray-300"></em>
            @endif

            @can('Upload photo')
                <div class="mt-3">
                    <x-input.file wire:model="profile_photo" hidden id="profile-photo"/>
                    <label wire:loading.class="disabled" wire:target="profile_photo" for="profile-photo" class="btn btn-sm btn-secondary">
                        <x-icons.upload wire:loading.remove="" wire:target="profile_photo"></x-icons.upload>
                        <x-icons.spinner wire:loading wire:target="profile_photo"></x-icons.spinner>
                        {{ __("Upload") }}
                    </label>
                </div>
            @endcan
        </div>
    </div>
</div>
