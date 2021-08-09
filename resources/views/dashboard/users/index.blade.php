@push('header_scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
@endpush

@push('footer_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
@endpush

<div class="row">
    <div class="col-12 sticky-lg-top bg-white shadow-sm">
        <div class="row">
            <div class="col-12 mx-auto d-flex justify-content-between px-4 py-3">
                <div class="fs-5">{{ __("Users") }}</div>
                <div>
                    @can('Create user')
                        <a href="{{ route('admin.users.create')}}" class="btn btn-primary btn-sm"><em class="fa fa-plus"></em> {{ __("Create") }}</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mx-auto p-4">
        <div class="row g-4">
            <div class="col-12 col-xl-8">
                @include('news::dashboard.users.partials.users-table')
            </div>
            <div wire:ignore class="col-12 col-xl-4">
                @include('news::dashboard.users.partials.users-status-graph')
            </div>
        </div>
    </div>
</div>
