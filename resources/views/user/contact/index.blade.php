@extends('layouts.master', ['title' => __("Contact")])

@push('meta')
    <meta name="description" content="{{ __("descriptions.contact") }}">
    <link rel="canonical" href="{{ route('user.contact.index') }}">
@endpush

@push('header_scripts')
    @include('user.contact.partials.organization-jsonld')
@endpush

@section('main')
    <div class="container-fluid py-4">
        <div class="container">

            <h1 class="mb-3">{{ __("Contact") }}</h1>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="h4">{{ config('app.name') }}</div>
                        <img src="{{ asset('storage/images/logo.png') }}" alt="{{ config('app.name') }}">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <tr>
                                <td class="text-nowrap text-secondary">{{ __("Legal name") }}</td>
                                <td>{{ config('app.name') }}</td>
                            </tr>
                            <tr>
                                <td class="text-nowrap text-secondary">{{ __("Address") }}</td>
                                <td>A. Manesi 5, Komotini 69100, Greece</td>
                            </tr>
                            <tr>
                                <td class="text-nowrap text-secondary">{{ __("Phone") }} 1</td>
                                <td>+30 25310 26001</td>
                            </tr>
                            <tr>
                                <td class="text-nowrap text-secondary">{{ __("Email") }} 1</td>
                                <td>cinarfm91.8@gmail.com</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
