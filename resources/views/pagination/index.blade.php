<div class="product_pagination">
    <ul>
        <!-- Добавляем стрелочки для перехода на предыдущую страницу -->
        @if ($paginator->onFirstPage())
            <li class="disabled">&laquo;</li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}">&laquo;</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Добавляем стрелочки для перехода на следующую страницу -->
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}">&raquo;</a></li>
        @else
            <li class="disabled">&raquo;</li>
        @endif
    </ul>
</div>
