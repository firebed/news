@props(['type' => 'a', 'href' => '#', 'disabled' => FALSE])

<li>
    @if($type === 'button')
        <button {{ $attributes->merge(['class' => 'dropdown-item py-2']) }} type="button" @if($disabled) disabled @endif {{ $attributes }}>{{ $slot }}</button>
    @elseif ($type === 'a')
        <a {{ $attributes->merge(['class' => 'dropdown-item py-2']) }} href="{{ $href }}" {{ $attributes }}>{{ $slot }}</a>
    @else
        {{ $slot }}
    @endif
</li>
