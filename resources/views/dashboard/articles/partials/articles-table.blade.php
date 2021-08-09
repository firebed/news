<x-news::table>
    <x-slot name="head">
        <x-news::table.heading class="w-7r">{{ __("Graphics") }}</x-news::table.heading>
        <x-news::table.heading class="w-7r">{{ __("ID") }}</x-news::table.heading>
        <x-news::table.heading sortable wire:click.prevent="sortBy('title')" :direction="$sortField === 'title' ? $sortDirection : null">{{ __("Title") }}</x-news::table.heading>
        <x-news::table.heading class="w-1r0">{{ __("Edited by") }}</x-news::table.heading>
        <x-news::table.heading class="w-1r0">{{ __("Article type") }}</x-news::table.heading>
        <x-news::table.heading class="w-8r" sortable wire:click.prevent="sortBy('views')" :direction="$sortField === 'views' ? $sortDirection : null">{{ __("Views") }}</x-news::table.heading>
        <x-news::table.heading class="w-8r" sortable wire:click.prevent="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">{{ __("Created at") }}</x-news::table.heading>
        <x-news::table.heading class="w-8r" sortable wire:click.prevent="sortBy('updated_at')" :direction="$sortField === 'updated_at' ? $sortDirection : null">{{ __("Updated at") }}</x-news::table.heading>
    </x-slot>
    @foreach($articles as $article)
        <tr wire:key="article-{{ $article->id }}">
            <td>
                <div class="ratio ratio-16x9">
                    @if($article->image)
                        <img src="{{ $article->image->url('sm') }}" alt="{{ $article->title }}" class="rounded">
                    @else
                        <div class="d-flex align-items-center">
                            <em class="fa fa-camera fa-4x text-gray-400"></em>
                        </div>
                    @endif
                </div>
            </td>
            <td>{{ $article->id }}</td>
            <td>
                <div class="d-flex flex-column">
                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-decoration-none {{ $article->visible ? 'text-dark' : 'text-danger' }} d-block">{{ $article->title }}</a>
                    @unless($article->visible)
                        <div>
                            <x-news::badge class="bg-danger">Yayında değil</x-news::badge>
                        </div>
                    @endunless
                </div>
            </td>
            <td>{{ $article->user->full_name }}</td>
            <td><x-news::badge class="w-8r" style="background-color: {{ $article->type->color }}">{{ $article->type->name }}</x-news::badge></td>
            <td>{{ $article->views }}</td>
            <td>{{ $article->created_at->format('d/m/y') }}</td>
            <td>{{ $article->updated_at->format('d/m/y') }}</td>
        </tr>
    @endforeach
</x-news::table>
