<div class="card shadow-sm">
    <div class="card-header fw-bold">{{ __("Tags") }} ({{ count($tags) }})</div>
    <div class="card-body scrollbar" style="max-height: 250px">
        <div class="mb-2">
            <form wire:submit.prevent="addTag">
                <div class="row gx-1">
                    <label class="col">
                        <input wire:model.defer="tag" wire:keydown.enter="addTag" type="text" class="form-control form-control-sm">
                    </label>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-secondary">
                            <em wire:loading.remove wire:target="addTag" class="fa fa-plus"></em>
                            <em wire:loading wire:target="addTag" class="fa fa-spinner fa-spin"></em>
                            {{ __("Add") }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex flex-row flex-wrap">
            @foreach($tags as $tag)
                <span class="badge bg-blue-100 me-1 mb-1">#{{ $tag }} <a href="#" class="ms-2" wire:click.prevent="removeTag('{{ $tag }}')"><em class="fa fa-times"></em></a></span>
            @endforeach
        </div>
    </div>
</div>
