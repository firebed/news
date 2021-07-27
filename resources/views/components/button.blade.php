<button {{ $attributes->merge(['class' => 'btn']) }} {{ $attributes }}>
    {{{ $slot }}}
</button>
