<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }

    .pagination li {
        margin-right: 10px;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        color: #333;
        text-decoration: none;
        font-size: 14px;
    }

    .pagination .active span {
        background-color: #007bff;
        color: #fff;
    }

    .pagination a:hover {
        background-color: #eee;
    }

    .pagination .disabled span {
        background-color: #ddd;
        color: #999;
    }

    .pagination .disabled a {
        cursor: not-allowed;
    }

    .pagination a,
    .pagination span {
        transition: background-color 0.3s;
    }
</style>
<ul class="pagination">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&laquo;</span>
        </li>
    @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array of links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
        </li>
    @else
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&raquo;</span>
        </li>
    @endif
</ul>
