<div class="card shadow-sm">
    <div class="card-body">
        <canvas id="active-status"></canvas>
        <div class="row row-cols-3 mt-3 text-center">
            <div class="col">
                <div class="text-secondary">{{ __('Active') }}</div>
                <div class="h4 text-blue-400">{{ $user_statuses[1]->count ?? 0 }}</div>
            </div>
            <div class="col">
                <div class="text-secondary">{{ __('Inactive') }}</div>
                <div class="h4 text-red-400">{{ $user_statuses[0]->count ?? 0 }}</div>
            </div>
            <div class="col">
                <div class="text-secondary">{{ __('Total') }}</div>
                <div class="h4">{{ $users->total() }}</div>
            </div>
        </div>
    </div>
</div>

@push('footer_scripts')
    <script>
        new Chart(document.getElementById('active-status'), {
            type: 'doughnut',
            options: {
                cutoutPercentage: 70,
                legend: {
                    display: false
                }
            },
            data: {
                datasets: [{
                    label: 'Status of employees',
                    data: [
                        '{{ $user_statuses[1]->count ?? 0 }}',
                        '{{ $user_statuses[0]->count ?? 0 }}'
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                    ]
                }],

                labels: [
                    '{{ __('Active') }}',
                    '{{ __('Inactive') }}',
                ]
            },
        });
    </script>
@endpush
