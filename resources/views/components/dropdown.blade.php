@props(['label' => ''])

<div class="dropdown">
    <button type="button"
            {{ $attributes->merge(['class' => 'btn dropdown-toggle']) }}
            data-bs-toggle="dropdown"
            aria-expanded="false" {{ $attributes }}>
        {{ $icon ?? '' }}
        {{ $label }}
    </button>

    {{ $slot }}
</div>
