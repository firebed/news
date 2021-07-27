<div id="sidebar" class="col-12 col-lg-3 col-xxl-2 px-0 sticky-top" x-data="{ show: false }">
    <div class="d-flex justify-content-between align-items-center sticky-top px-3 w-100" style="height: 3.5rem; background-color: rgb(49, 58, 70);">
        <div class="fs-5 fw-500 text-light d-flex justify-content-between">
            <div class="bg-red-500 rounded text-center me-2" style="width: 2rem">M</div>
            <div>Millet Gazetesi</div>
        </div>

        <button type="button" class="btn btn-link text-light d-lg-none" x-on:click="show = !show">
            <em class="fa fa-bars"></em>
        </button>
    </div>

    <div x-bind:class="{ 'show': show }" class="sidebar sticky-lg-top w-100" data-bs-backdrop="false" style="--top: 3.5rem">
        <div class="h-100" data-simplebar>
            <div class="d-grid">
                @canany('View articles', 'Create article')
                    <div class="bg-gray-900 px-3 py-2">{{ __("Articles") }}</div>
                @endcanany

                @can('View articles')
                    <a href="{{ route('admin.articles.index') }}" class=""><i class="fas fa-align-left wpx-2"></i>{{ __("All articles") }}</a>
                @endcan

                @can('Create article')
                    <a href="{{ route('admin.articles.create') }}" class=""><i class="fas fa-plus wpx-2"></i>{{ __("Add article") }}</a>
                @endcan

                @canany('View users', 'Create user')
                    <div class="bg-gray-900 px-3 py-2">{{ __("Users") }}</div>
                @endcanany

                @can('View users')
                    <a href="{{ route('admin.users.index') }}" class=""><i class="fas fa-users wpx-2"></i>{{ __("All users") }}</a>
                @endcan

                @can('Create user')
                    <a href="{{ route('admin.users.create') }}" class=""><i class="fas fa-user-plus wpx-2"></i>{{ __("Add user") }}</a>
                @endcan
            </div>
        </div>
    </div>
</div>

{{--<div id="dashboard-nav" class="col-auto px-0 d-flex flex-column shadow">--}}
{{--    <div class="px-3 py-2 fs-3">--}}
{{--        <span class="text-warning border-bottom border-info border-2">L E</span>--}}
{{--        <span class="text-info">X A</span>--}}
{{--    </div>--}}

{{--    <div class="d-flex p-3" style="background-color:rgba(0, 0, 0, .2)">--}}
{{--        <div class="col-auto">--}}
{{--            @isset(user()->image)--}}
{{--                <x-avatar class="bg-white" url="{{ auth()->user()->image->url() }}"/>--}}
{{--            @else--}}
{{--                <x-icons.user class="fa-2x" />--}}
{{--            @endisset--}}
{{--        </div>--}}
{{--        <div class="col ps-2">--}}
{{--            <div class="text-light">{{ auth()->user()->full_name }}</div>--}}
{{--            <form action="{{ route('logout') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <x-button class="btn-link btn-sm p-0 text-gray-500 text-decoration-none">{{ __("Logout") }}</x-button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="d-flex flex-column">--}}
{{--        @canany('View articles', 'Create article')--}}
{{--            <div class="bg-gray-900 px-3 py-2">{{ __("Articles") }}</div>--}}
{{--        @endcanany--}}
{{--        @can('View articles')--}}
{{--            <a href="{{ route('admin.articles.index') }}" class=""><i class="fas fa-align-left wpx-2"></i>{{ __("All articles") }}</a>--}}
{{--        @endcan--}}
{{--        @can('Create article')--}}
{{--            <a href="{{ route('admin.articles.create') }}" class=""><i class="fas fa-plus wpx-2"></i>{{ __("Add article") }}</a>--}}
{{--        @endcan--}}

{{--        @canany('View users', 'Create user')--}}
{{--            <div class="bg-gray-900 px-3 py-2">{{ __("Users") }}</div>--}}
{{--        @endcanany--}}
{{--        @can('View users')--}}
{{--            <a href="{{ route('admin.users.index') }}" class=""><i class="fas fa-users wpx-2"></i>{{ __("All users") }}</a>--}}
{{--        @endcan--}}
{{--        @can('Create user')--}}
{{--            <a href="{{ route('admin.users.create') }}" class=""><i class="fas fa-user-plus wpx-2"></i>{{ __("Add user") }}</a>--}}
{{--        @endcan--}}
{{--    </div>--}}
{{--</div>--}}
