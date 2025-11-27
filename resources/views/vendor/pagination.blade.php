@if ($paginator->hasPages())
    <div class="pagination-outer">
        <div class="pagination-style1">
            <ul class="clearfix">
                {{-- Önceki Sayfa Linki --}}
                @if ($paginator->onFirstPage())
                    <li class="prev disabled"><a href="javascript:;"><span> <i class="fa fa-angle-left"></i> </span></a></li>
                @else
                    <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><span> <i class="fa fa-angle-left"></i> </span></a></li>
                @endif

                {{-- Sayfa Numaraları --}}
                @foreach ($elements as $element)
                    {{-- "Üç Nokta" Ayırıcı --}}
                    @if (is_string($element))
                        <li><a href="javascript:;"><i class="fa fa-ellipsis-h"></i></a></li>
                    @endif

                    {{-- Sayfa Linkleri --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="javascript:;">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Sonraki Sayfa Linki --}}
                @if ($paginator->hasMorePages())
                    <li class="next"><a href="{{ $paginator->nextPageUrl() }}"><span> <i class="fa fa-angle-right"></i> </span></a></li>
                @else
                    <li class="next disabled"><a href="javascript:;"><span> <i class="fa fa-angle-right"></i> </span></a></li>
                @endif
            </ul>
        </div>
    </div>
@endif
