@props(['active' => FALSE])

@if($active)
    <li {{ $attributes->merge(['class' => 'breadcrumb-item active']) }} {{ $attributes }} aria-current="page">{{ $slot }}</li>
@else
    <li {{ $attributes->merge(['class' => 'breadcrumb-item']) }} {{ $attributes }}>{{ $slot }}</li>
@endif
