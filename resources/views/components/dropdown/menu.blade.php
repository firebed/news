@props(['alignment' => 'left', 'theme' => NULL, 'aria'])

<ul
    {{ $attributes->merge(['class' => 'dropdown-menu' . ($theme ? " dropdown-menu-$theme" : '') . ($alignment === 'right' ? ' dropdown-menu-end' : '')]) }}
    {{ $attributes }}
    aria-labelledby="{{ $aria }}">

    {{ $slot }}
</ul>
