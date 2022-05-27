@if ($paginator->hasPages())

<div class="row">

    <div class="col-md-7 col-sm-7">
        <div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
            <ul class="pagination" style="visibility: visible;">
                @if ($paginator->onFirstPage())
                <li class="prev disabled">
                    <a href="#" title="First"><i class="fa fa-angle-double-right"></i></a>
                </li>
                <li class="prev disabled"><a href="#" title="Prev"><i class="fa fa-angle-right"></i></a></li>
                @else
            <li class="prev">
                <a href="{{ $paginator->url(1)}}" title="First"><i class="fa fa-angle-double-right"></i></a>
            </li>
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" title="Prev"><i class="fa fa-angle-right"></i></a></li>
            @endif
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)

            <li class="{{$paginator->currentPage()  == $i ? 'active':''}}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endfor
            @if ($paginator->currentPage() == $paginator->lastPage())
            <li class="next disabled"><a href="#" title="Next"><i class="fa fa-angle-left"></i></a></li>
            <li class="next disabled"><a href="#" title="Last"><i class="fa fa-angle-double-left"></i></a></li>

            @else

            <li class="next"><a href="{{ $paginator->nextPageUrl() }}" title="Next"><i class="fa fa-angle-left"></i></a></li>
            <li class="next"><a href="{{ $paginator->url($paginator->lastPage()) }}" title="Last"><i class="fa fa-angle-double-left"></i></a></li>
            @endif
        </ul>
    </div>
</div>
</div>
@endif
