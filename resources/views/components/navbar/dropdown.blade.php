@props(['label'])

<li class="nav-item dropdown">
    <a {{ $attributes->merge(['class' => 'nav-link']) }} href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $label }} <em class="fa fa-chevron-down ms-1 small"></em>
    </a>
    {{ $slot }}
</li>
