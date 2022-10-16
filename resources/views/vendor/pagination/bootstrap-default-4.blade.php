{{--@if ($paginator->hasPages())--}}
{{--<ul class="pagination pagination">--}}
{{-- Previous Page Link --}}
{{--@if ($paginator->onFirstPage())--}}
{{--<li class="disabled"><span>«</span></li>--}}
{{--@else--}}
{{--<li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>--}}
{{--@endif--}}

{{--@if($paginator->currentPage() > 3)--}}
{{--<li class="hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></li>--}}
{{--@endif--}}
{{--@if($paginator->currentPage() > 4)--}}
{{--<li><span>...</span></li>--}}
{{--@endif--}}
{{--@foreach(range(1, $paginator->lastPage()) as $i)--}}
{{--@if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)--}}
{{--@if ($i == $paginator->currentPage())--}}
{{--<li class="active"><span>{{ $i }}</span></li>--}}
{{--@else--}}
{{--<li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>--}}
{{--@endif--}}
{{--@endif--}}
{{--@endforeach--}}
{{--@if($paginator->currentPage() < $paginator->lastPage() - 3)--}}
{{--<li><span>...</span></li>--}}
{{--@endif--}}
{{--@if($paginator->currentPage() < $paginator->lastPage() - 2)--}}
{{--<li class="hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>--}}
{{--@endif--}}

{{-- Next Page Link --}}
{{--@if ($paginator->hasMorePages())--}}
{{--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>--}}
{{--@else--}}
{{--<li class="disabled"><span>»</span></li>--}}
{{--@endif--}}
{{--</ul>--}}
{{--@endif--}}


@if ($paginator->hasPages())
    <ul class="pagination pagination-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link"></span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"></a></li>
        @endif

        @if($paginator->currentPage() > 3)
            <li class="page-item hidden-xs"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
        @endif

        @if($paginator->currentPage() > 4)
            <li class="page-item disabled hidden-xs"><span class="page-link">...</span></li>
        @endif

        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item" ><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach

        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="page-item disabled hidden-xs"><span class="page-link">...</span></li>
        @endif

        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="page-item hidden-xs"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"></a></li>
        @else
            <li class="page-item disabled"><span class="page-link"></span></li>
        @endif
    </ul>
@endif
