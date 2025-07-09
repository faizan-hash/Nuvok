@if ($paginator->hasPages())
    <div class="center">
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a disabled><i class="fa-solid fa-chevron-left custom-c"></i></a>
            @else
                <button onclick="window.location='{{ $paginator->previousPageUrl() }}'">
                    <i class="fa-solid fa-chevron-left custom-c"></i>
                </button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <button disabled>{{ $element }}</button>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="active">{{ $page }}</button>
                        @else
                            <button onclick="window.location='{{ $url }}'">{{ $page }}</button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a onclick="window.location='{{ $paginator->nextPageUrl() }}'">
                    <i class="fa-solid fa-chevron-right custom-c"></i>
                </a>
            @else
                <a disabled><i class="fa-solid fa-chevron-right custom-c"></i></a>
            @endif
        </div>
    </div>
@endif
