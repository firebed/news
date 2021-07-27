<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="wpx-8">{{ __("Graphics") }}</th>
                    <th>{{ __("Name") }}</th>
                    <th>{{ __("Status") }}</th>
                    <th class="text-end text-nowrap">{{ __("Total articles") }}</th>
                    <th class="text-end text-nowrap">{{ __("Latest article") }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            @isset($user->image)
                                <a href="{{ route('admin.users.edit', $user) }}">
                                    <x-avatar class="bg-white" url="{{ $user->image->url() }}"/>
                                </a>
                            @endisset
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-decoration-none text-dark d-flex flex-column">
                                @if($user->title)
                                    <small class="fw-bold">{{ $user->title }}</small>
                                @endif
                                <span>{{ $user->full_name }}</span>
                                <small class="text-secondary">{{ $user->email }}</small>
                            </a>
                        </td>
                        <td>
                            @if($user->active)
                                <x-badge class="wpx-5 bg-teal-500">{{ __("Active") }}</x-badge>
                            @else
                                <x-badge class="wpx-5 bg-warning">{{ __("Inactive") }}</x-badge>
                            @endif
                        </td>
                        <td class="text-end">{{ $user->articles_count }}</td>
                        <td class="text-end">@if($user->latestArticle) {{ $user->latestArticle->created_at->format('d/m/y') }} @else - @endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
