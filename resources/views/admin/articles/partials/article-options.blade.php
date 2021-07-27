<div class="card shadow-sm mb-4">
    <div class="card-body">
        <table class="table table-sm">
            <tr>
                <td class="text-secondary">{{ __("Created at") }}</td>
                <td class="text-end">{{ optional($article->created_at)->isoFormat('D MMMM YYYY, HH:mm') }}</td>
            </tr>
            <tr>
                <td class="text-secondary">{{ __("Updated at") }}</td>
                <td class="text-end">{{ optional($article->updated_at)->isoFormat('D MMMM YYYY, HH:mm') }}</td>
            </tr>
            <tr>
                <td class="text-secondary">{{ __("Edited by") }}</td>
                <td class="text-end">{{ optional($this->article->user)->full_name }}</td>
            </tr>
            <tr>
                <td class="text-secondary">{{ __("Views") }}</td>
                <td class="text-end">{{ $article->views }}</td>
            </tr>
            <tr>
                <td class="text-secondary">{{ __("Size") }}</td>
                <td class="text-end">{{ $this->size_on_disk ?? 0 }}</td>
            </tr>
        </table>

        <div class="row gx-2">
            <div class="col">
                <label for="article-type" class="form-label small text-secondary">{{ __("Article type") }}</label>
                <x-input.select wire:model="article.type_id" id="type-id" error="article.type_id">
                    <option value="">{{ __("Select type") }}</option>
                    @foreach($this->types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </x-input.select>
            </div>
            @if($article->type_id && $this->types->find($article->type_id)->isColumn())
                <div class="col">
                    <label for="author" class="form-label small text-secondary">{{ __("Author") }}</label>
                    <x-input.select wire:model.defer="article.author_id" id="author" error="article.author_id">
                        <option value="">{{ __("Select author") }}</option>
                        @foreach($this->authors as $author)
                            <option value="{{ $author->id }}">{{ $author->full_name }}</option>
                        @endforeach
                    </x-input.select>
                </div>
            @endif
        </div>

    </div>
</div>
