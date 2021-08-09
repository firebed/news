<div class="row">
    <div class="col-12 sticky-lg-top bg-white shadow-sm">
        <div class="row">
            <div class="col-12 mx-auto d-flex justify-content-between px-4 py-3">
                <div class="fs-5">{{ __("All articles") }}</div>
                <div>
                    @can('Create article')
                        <a href="{{ route('admin.articles.create')}}" class="btn btn-primary btn-sm"><em class="fa fa-plus"></em> {{ __("Add article") }}</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 p-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="row row-cols-1 row-cols-sm-3 g-2">
                    <div class="col">
                        <x-news::input.search wire:model="article_id" id="article-id" placeholder="{{ __('Search by id') }}"/>
                    </div>

                    <div class="col">
                        <x-news::input.search wire:model="search" placeholder="{{ __('Search by content') }}"/>
                    </div>

                    <div class="col">
                        <x-news::input.select class="form-control" wire:model="selected_type">
                            <option value="">{{ __("Article type") }}</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->articles_count }})</option>
                            @endforeach
                        </x-news::input.select>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('news::dashboard.articles.partials.articles-table')
                        </div>
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>