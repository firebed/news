<div class="col">
    <div class="row">
        <div class="col h-100">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="fw-bold fs-4 text-blue-500 text-end">{{ $article->views }}</div>
                    <div class="small text-secondary text-end">{{ __("Views") }}</div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="{{ route('admin.articles.edit', $article->id) }}" target="_blank" class="btn btn-sm btn-primary">{{ __("Edit article") }}</a>
                </div>
            </div>
        </div>

    </div>
</div>
