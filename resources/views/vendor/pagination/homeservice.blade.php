@if ($paginator->hasPages())
<nav class="hs-pagination" aria-label="Pagination">
    <ul class="hs-pagination-list">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="hs-page-item hs-page-disabled">
                <span class="hs-page-link"><i class="bi bi-chevron-left"></i></span>
            </li>
        @else
            <li class="hs-page-item">
                <a class="hs-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="hs-page-item hs-page-disabled">
                    <span class="hs-page-link">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="hs-page-item hs-page-active" aria-current="page">
                            <span class="hs-page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="hs-page-item">
                            <a class="hs-page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="hs-page-item">
                <a class="hs-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Selanjutnya">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="hs-page-item hs-page-disabled">
                <span class="hs-page-link"><i class="bi bi-chevron-right"></i></span>
            </li>
        @endif

    </ul>
    <div class="hs-pagination-info">
        Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
        dari {{ $paginator->total() }} data
    </div>
</nav>
@endif
