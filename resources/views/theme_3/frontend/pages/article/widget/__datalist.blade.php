@if(isset($data) )
<div class="row px-2">
    @foreach($data as $item)
    <div class="col-6 col-lg-3 px-2 mt-2 mb-3">
        <div class="article mb-3">
            <div class="article--thumbnail">
                <a href="/tin-tuc/{{ $item->slug }}">
                    <img src="{{\App\Library\MediaHelpers::media($item->image)}}"
                        alt="" class="article--thumbnail__image">
                </a>
            </div>
            <div class="article--title my-3">
                    <a href="/tin-tuc/{{ $item->slug }}"> {{ $item->title }} </a>
            </div>
            <div class="article--date">
                <i class="__icon calendar mr-2"></i>
                {{ formatDateTime($item->created_at) }}
            </div>
        </div>
    </div>
    @endforeach
        @else
            <div class="row pb-3 pt-3">
                <div class="col-md-12 text-center">
                    <span style="color: red;font-size: 16px;">Không có dữ liệu !</span>
                </div>
            </div>
        @endif
    <div class="col-md-12 left-right justify-content-end default-paginate">
        <div class="row marinautooo justify-content-center">
            <div class="col-auto">
                <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                    <ul class="pagination pagination-sm">
                        <li class="page-item disabled">
                            <a href="" class="page-link">
                            </a>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="">3</a>
                        </li>
                        <li class="page-item disabled hidden-xs">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item hidden-xs">
                            <a class="page-link" href="">14</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="" rel="next"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
