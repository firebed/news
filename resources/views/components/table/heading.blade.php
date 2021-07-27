@props([
    'sortable' => null,
    'direction' => null,
])

<td {{ $attributes->merge(['class' => $sortable ? 'sortable' : '']) }} {{ $attributes }}>
    @unless ($sortable)
        {{ $slot }}
    @else
        <a href="#" class="d-flex align-items-center shadow-none text-decoration-none text-dark">
            <span>{{ $slot }}</span>
            @if ($direction === 'asc')
                <svg class="text-secondary" style="width: .75rem; height: .75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            @elseif ($direction === 'desc')
                <svg class="text-secondary" style="width: .75rem; height: .75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            @else
                <svg class="opacity-0 text-secondary" style="width: .75rem; height: .75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            @endif
        </a>
    @endunless
</td>
