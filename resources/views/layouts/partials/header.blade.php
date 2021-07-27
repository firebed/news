<div id="header" class="container-fluid d-none d-xl-block">
    <div class="container">
        <div class="row py-2 justify-content-center justify-content-sm-start">
            <a href="{{ route('user.homepage') }}" class="col-8 col-xl-2 text-center text-sm-start">
                <img src="{{ asset('/storage/images/desk_buyuk.png') }}" class="img-fluid" alt="Millet gazetesi logo" width="170" height="70">
            </a>

            <div class="col d-flex justify-content-center align-items-center">
                <div class="row align-items-center">
                    <a href="https://cinarfm.gr/" class="col-auto" target="_blank">
                        <img src="https://cinarfm.gr/images/logo.jpg" alt="" width="100" height="45">
                    </a>

                    @include('layouts.partials.weather-forecast')
                    @include('layouts.partials.prayer')
                </div>
            </div>

            <div class="col-auto d-flex justify-content-end align-items-center" style="width: 205px !important">
                <div class="addthis_horizontal_follow_toolbox"></div>
            </div>
        </div>
    </div>
</div>

<x-navbar class="bg-red-600 py-0 py-lg-1" theme="dark" expand="xl">
    <x-navbar.brand class="d-flex py-2 flex-column d-xl-none" href="{{ route('user.homepage') }}">
        <img src="{{ asset('storage/images/mobile.png') }}" class="img-fluid float-start" alt="Millet gazetesi logo" width="120" height="46">
    </x-navbar.brand>

    <x-navbar.toggler target="main-navigation"/>

    <x-navbar.collapse id="main-navigation" class="mb-2 mb-xl-0">
        <x-navbar.nav class="me-auto">
            <x-navbar.link class="ps-0 text-light" href="{{ route('user.homepage') }}"><em class="fa fa-home d-none d-xl-inline-block"></em><span class="d-xl-none">{{ __('Homepage') }}</span></x-navbar.link>
            <x-navbar.dropdown class="text-light" id="news" label="{{ __('News') }}">
                <x-dropdown.menu class="mt-1 bg-red-600" theme="dark" aria="news">
                    <x-dropdown.item href="{{ route('user.articles.all_news') }}">{{ __('All news') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'bati-trakya') }}">{{ __('Western Thrace') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'yunanistan') }}">{{ __('Greece') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'turkiye') }}">{{ __('Turkey') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'balkanlar') }}">{{ __('Balkans') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'dunya') }}">{{ __('World') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'spor') }}">{{ __('Sports') }}</x-dropdown.item>
                </x-dropdown.menu>
            </x-navbar.dropdown>
            <x-navbar.link class="text-light" href="{{ route('user.articles.index', 'yunanca') }}">Ειδήσεις - Άρθρα</x-navbar.link>
            <x-navbar.link class="text-light" href="{{ route('user.authors.index') }}">{{ __("Authors") }}</x-navbar.link>
            <x-navbar.link class="text-light" href="{{ route('user.articles.index', 'fotograf') }}">{{ __("Photo") }}</x-navbar.link>
            <x-navbar.link class="text-light" href="{{ route('user.articles.index', 'video') }}">{{ __("Video") }}</x-navbar.link>
            <x-navbar.link class="text-light" href="{{ route('user.articles.index', 'analiz') }}">{{ __("Analysis") }}</x-navbar.link>
            <x-navbar.link class="text-light" href="{{ route('user.articles.index', 'infografik') }}">{{ __("Infographics") }}</x-navbar.link>
            <x-navbar.link class="text-light" href="{{ route('user.contact.index') }}">{{ __("Contact") }}</x-navbar.link>

            <x-navbar.dropdown class="text-light" id="other" label="{{ __('Other') }}">
                <x-dropdown.menu class="mt-1 bg-red-600" theme="dark" aria="other">
                    <x-dropdown.item href="{{ route('user.articles.index', 'kose-yazilari') }}">{{ __('Columns') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'kultur-sanat') }}">{{ __('Art and Culture') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'tarih') }}">{{ __('History') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'din-toplum') }}">{{ __('Religion - Society') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'pomak-turkleri') }}">{{ __('Pomak Turks') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'portre') }}">{{ __('Portrait') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'bilim-teknoloji') }}">{{ __('Science - Technology') }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'ekonomi') }}">{{ __("Economy") }}</x-dropdown.item>
                    <x-dropdown.item href="{{ route('user.articles.index', 'saglik') }}">{{ __("Health") }}</x-dropdown.item>
                </x-dropdown.menu>
            </x-navbar.dropdown>

            <x-navbar.dropdown class="text-light" id="account" label="{{ __('Account') }}">
                <x-dropdown.menu class="mt-1 bg-red-600" theme="dark" aria="account">
                    @guest
                        <x-dropdown.item href="{{ route('login') }}">{{ __('Login') }}</x-dropdown.item>
                    @else
                        @can('View dashboard')
                            <x-dropdown.item target="__blank" href="{{ route('admin.dashboard') }}"><em class="fa small fa-tachometer-alt wpx-2"></em>{{ __('Dashboard') }}</x-dropdown.item>
                            <x-dropdown.divider/>
                        @endcan
                        @can('View articles')
                            <x-dropdown.item target="__blank" href="{{ route('admin.articles.index') }}"><em class="fa small fa-align-left wpx-2"></em>{{ __('All articles') }}</x-dropdown.item>
                        @endcan
                        @can('Create article')
                            <x-dropdown.item target="__blank" href="{{ route('admin.articles.create') }}"><em class="fa small fa-plus wpx-2"></em>{{ __('Add article') }}</x-dropdown.item>
                            <x-dropdown.divider/>
                        @endcan
                        <x-dropdown.item class="px-0">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn text-start px-3 py-0 text-decoration-none nav-link w-100">
                                    <em class="fa small fa-sign-out-alt wpx-2"></em>{{ __('Logout') }}
                                </button>
                            </form>
                        </x-dropdown.item>
                    @endguest
                </x-dropdown.menu>
            </x-navbar.dropdown>
        </x-navbar.nav>

        <form class="d-flex" method="GET" action="{{ route('user.articles.search')}}">
            <label for="search" class="d-none">{{ __("Search") }}</label>
            <input class="form-control me-2" id="search" type="search" value="{{ request()->input('q') ?? '' }}" name="q" placeholder="{{ __("News search") }}..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">{{ __("Search") }}</button>
        </form>
    </x-navbar.collapse>
</x-navbar>
