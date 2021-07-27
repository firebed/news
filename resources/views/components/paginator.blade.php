@if($paginator->hasPages())
    <span>{{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }} - {{ $paginator->currentPage() * $paginator->perPage() }} of {{ $paginator->total() }}</span>
    @if($paginator->onFirstPage())
        <span class="text-gray-500 p-2 mx-3"><em class="fa fa-chevron-left"></em></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="text-secondary p-2 mx-3"><em class="fa fa-chevron-left"></em></a>
    @endif

    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="text-secondary p-2"><em class="fa fa-chevron-right"></em></a>
    @else
        <span class="text-gray-500 p-2 mx-3"><em class="fa fa-chevron-right"></em></span>
    @endif
@endif
