<x-table>
    <x-slot name="head">
        <x-table.heading class="wpx-7">{{ __("Graphics") }}</x-table.heading>
        <x-table.heading class="wpx-7">{{ __("ID") }}</x-table.heading>
        <x-table.heading sortable wire:click.prevent="sortBy('title')" :direction="$sortField === 'title' ? $sortDirection : null">{{ __("Title") }}</x-table.heading>
        <x-table.heading class="wpx-10">{{ __("Edited by") }}</x-table.heading>
        <x-table.heading class="wpx-10">{{ __("Article type") }}</x-table.heading>
        <x-table.heading class="wpx-8" sortable wire:click.prevent="sortBy('views')" :direction="$sortField === 'views' ? $sortDirection : null">{{ __("Views") }}</x-table.heading>
        <x-table.heading class="wpx-8" sortable wire:click.prevent="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">{{ __("Created at") }}</x-table.heading>
        <x-table.heading class="wpx-8" sortable wire:click.prevent="sortBy('updated_at')" :direction="$sortField === 'updated_at' ? $sortDirection : null">{{ __("Updated at") }}</x-table.heading>
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
                            <x-badge class="bg-danger">Yayında değil</x-badge>
                        </div>
                    @endunless
                </div>
            </td>
            <td>{{ $article->user->full_name }}</td>
            <td><x-badge class="wpx-8" style="background-color: {{ $article->type->color }}">{{ $article->type->name }}</x-badge></td>
            <td>{{ $article->views }}</td>
            <td>{{ $article->created_at->format('d/m/y') }}</td>
            <td>{{ $article->updated_at->format('d/m/y') }}</td>
        </tr>
    @endforeach
</x-table>
