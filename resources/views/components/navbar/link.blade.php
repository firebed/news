@props(['active' => FALSE])

<li class="nav-item">
    <a {{ $attributes->merge(['class' => 'nav-link' . ($active ? ' active' : '')]) }} {{ $attributes }} {{ $attributes }}>{{ $slot }}</a>
</li>
