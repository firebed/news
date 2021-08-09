<div>
    @include('news::dashboard.users.partials.user-header', ['title' => __("Update user")])

    <div class="row justify-content-center p-4">
        <div class="col-12 col-xxl-10">
            <div class="row g-4">
                <div class="col-12">
                    @can('View users')
                        <a href="{{ route('admin.users.index') }}" class="small text-decoration-none text-secondary mb-1"><em class="fa fa-chevron-left"></em> {{ __("All users") }}</a>
                    @endcan
                    <h1 wire:ignore class="fs-3">{{ $user->full_name }}</h1>
                </div>

                <div class="col-12 col-xl-7 col-xxl-8">
                    @include('news::dashboard.users.partials.personal-info')

                    @can('Manage permissions')
                        @include('news::dashboard.users.partials.user-status')
                        @include('news::dashboard.users.partials.permissions')
                    @endcan

                    @can('Delete user')
{{--                        <div class="col">--}}
{{--                            Delete user--}}
{{--                        </div>--}}
                    @endcan
                </div>

                <div class="col-12 col-xl-5 col-xxl-4">
                    @include('news::dashboard.users.partials.profile-image')
                    @include('news::dashboard.users.partials.cover-image')
                </div>
            </div>
        </div>
    </div>
</div>
