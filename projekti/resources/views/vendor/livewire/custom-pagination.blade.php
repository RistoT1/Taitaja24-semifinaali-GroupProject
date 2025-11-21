@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li>
                <button type="button"
                        wire:click="previousPage"
                        class="page-link">&laquo;</button>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li>
                            <button type="button"
                                    wire:click="gotoPage({{ $page }})"
                                    class="page-link">{{ $page }}</button>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <li>
                <button type="button"
                        wire:click="nextPage"
                        class="page-link">&raquo;</button>
            </li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif