<div>
    @include('admin.users.partials.user-header', ['title' => __("Create user")])

    <div class="row justify-content-center p-4">
        <div class="col-12 col-xxl-10">
            <div class="row g-4">
                <div class="col-12 col-xl-7 col-xxl-8">
                    @include('admin.users.partials.personal-info')

                    @can('Manage permissions')
                        @include('admin.users.partials.user-status')
                        @include('admin.users.partials.permissions')
                    @endcan
                </div>

                <div class="col-12 col-xl-5 col-xxl-4">
                    @include('admin.users.partials.profile-image')
                    @include('admin.users.partials.cover-image')
                </div>
            </div>
        </div>
    </div>
</div>
