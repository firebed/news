<div id="header" class="container-fluid d-none d-xl-block bg-white">
    <div class="container">
        <div class="row py-2 justify-content-center justify-content-sm-start">
            <a href="{{ route('user.homepage') }}" class="col-8 col-xl-2 text-center text-sm-start">
                <img src="{{ asset('/storage/images/logo.jpg') }}" class="img-fluid" alt="{{ config('app.name') }}" width="170" height="77">
            </a>

{{--            <div class="col d-flex justify-content-center align-items-center">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <a href="https://cinarfm.gr/" class="col-auto" target="_blank">--}}
{{--                        <img src="https://cinarfm.gr/images/logo.jpg" alt="" width="100" height="45">--}}
{{--                    </a>--}}

{{--                    @include('news::layouts.partials.weather-forecast')--}}
{{--                    @include('news::layouts.partials.prayer')--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="col-auto d-flex justify-content-end align-items-center" style="width: 205px !important">
                <div class="addthis_horizontal_follow_toolbox"></div>
            </div>
        </div>
    </div>
</div>

<x-news::navbar class="bg-red-600 py-0 py-lg-1" theme="dark" expand="xl">
    <x-news::navbar.brand class="d-flex py-2 flex-column d-xl-none" href="{{ route('user.homepage') }}">
        <img src="{{ asset('storage/images/logo.jpg') }}" class="img-fluid float-start" alt="{{ config('app.name') }}" width="120" height="46">
    </x-news::navbar.brand>

    <x-news::navbar.toggler target="main-navigation"/>

    <x-news::navbar.collapse id="main-navigation" class="mb-2 mb-xl-0">
        <x-news::navbar.nav class="me-auto">
            <x-news::navbar.link class="ps-0 text-light" href="{{ route('user.homepage') }}"><em class="fa fa-home d-none d-xl-inline-block"></em><span class="d-xl-none">{{ __('Homepage') }}</span></x-news::navbar.link>
            <x-news::navbar.dropdown class="text-light" id="news" label="{{ __('News') }}">
                <x-news::dropdown.menu class="mt-1 bg-red-600" theme="dark" aria="news">
                    <x-news::dropdown.item href="{{ route('user.articles.all_news') }}">{{ __('All news') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'bati-trakya') }}">{{ __('Western Thrace') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'yunanistan') }}">{{ __('Greece') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'turkiye') }}">{{ __('Turkey') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'balkanlar') }}">{{ __('Balkans') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'dunya') }}">{{ __('World') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'spor') }}">{{ __('Sports') }}</x-news::dropdown.item>
                </x-news::dropdown.menu>
            </x-news::navbar.dropdown>
            <x-news::navbar.link class="text-light" href="{{ route('user.articles.index', 'yunanca') }}">Ειδήσεις - Άρθρα</x-news::navbar.link>
            <x-news::navbar.link class="text-light" href="{{ route('user.authors.index') }}">{{ __("Authors") }}</x-news::navbar.link>
            <x-news::navbar.link class="text-light" href="{{ route('user.articles.index', 'fotograf') }}">{{ __("Photo") }}</x-news::navbar.link>
            <x-news::navbar.link class="text-light" href="{{ route('user.articles.index', 'video') }}">{{ __("Video") }}</x-news::navbar.link>
            <x-news::navbar.link class="text-light" href="{{ route('user.articles.index', 'analiz') }}">{{ __("Analysis") }}</x-news::navbar.link>
            <x-news::navbar.link class="text-light" href="{{ route('user.articles.index', 'infografik') }}">{{ __("Infographics") }}</x-news::navbar.link>
            <x-news::navbar.link class="text-light" href="{{ route('user.contact.index') }}">{{ __("Contact") }}</x-news::navbar.link>

            <x-news::navbar.dropdown class="text-light" id="other" label="{{ __('Other') }}">
                <x-news::dropdown.menu class="mt-1 bg-red-600" theme="dark" aria="other">
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'kose-yazilari') }}">{{ __('Columns') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'kultur-sanat') }}">{{ __('Art and Culture') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'tarih') }}">{{ __('History') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'din-toplum') }}">{{ __('Religion - Society') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'pomak-turkleri') }}">{{ __('Pomak Turks') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'portre') }}">{{ __('Portrait') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'bilim-teknoloji') }}">{{ __('Science - Technology') }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'ekonomi') }}">{{ __("Economy") }}</x-news::dropdown.item>
                    <x-news::dropdown.item href="{{ route('user.articles.index', 'saglik') }}">{{ __("Health") }}</x-news::dropdown.item>
                </x-news::dropdown.menu>
            </x-news::navbar.dropdown>

            <x-news::navbar.dropdown class="text-light" id="account" label="{{ __('Account') }}">
                <x-news::dropdown.menu class="mt-1 bg-red-600" theme="dark" aria="account">
                    @guest
                        <x-news::dropdown.item href="{{ route('login') }}">{{ __('Login') }}</x-news::dropdown.item>
                    @else
                        @can('View dashboard')
                            <x-news::dropdown.item target="__blank" href="{{ route('admin.dashboard') }}"><em class="fa small fa-tachometer-alt w-2r"></em>{{ __('Dashboard') }}</x-news::dropdown.item>
                            <x-news::dropdown.divider/>
                        @endcan
                        @can('View articles')
                            <x-news::dropdown.item target="__blank" href="{{ route('admin.articles.index') }}"><em class="fa small fa-align-left w-2r"></em>{{ __('All articles') }}</x-news::dropdown.item>
                        @endcan
                        @can('Create article')
                            <x-news::dropdown.item target="__blank" href="{{ route('admin.articles.create') }}"><em class="fa small fa-plus w-2r"></em>{{ __('Add article') }}</x-news::dropdown.item>
                            <x-news::dropdown.divider/>
                        @endcan
                        <x-news::dropdown.item class="px-0">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn text-start px-3 py-0 text-decoration-none nav-link w-100">
                                    <em class="fa small fa-sign-out-alt w-2r"></em>{{ __('Logout') }}
                                </button>
                            </form>
                        </x-news::dropdown.item>
                    @endguest
                </x-news::dropdown.menu>
            </x-news::navbar.dropdown>
        </x-news::navbar.nav>

        <form class="d-flex" method="GET" action="{{ route('user.articles.search')}}">
            <label for="search" class="d-none">{{ __("Search") }}</label>
            <input class="form-control me-2" id="search" type="search" value="{{ request()->input('q') ?? '' }}" name="q" placeholder="{{ __("News search") }}..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">{{ __("Search") }}</button>
        </form>
    </x-news::navbar.collapse>
</x-news::navbar>
