@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('meta_robots')
    <meta name="robots" content="index,follow" />
@endsection
@section('scripts')
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/js_trong/script_trong.js"></script>
@endsection
@section('content')

    <div class="container-fix container">
        {{--breadcrum--}}
        <ul class="breadcrum--list">
            <li class="breadcrum--item">
                <a href="/" class="breadcrum--link">Trang chủ</a>
            </li>
            <li class="breadcrum--item">
                <a href="" class="breadcrum--link">Tin tức</a>
            </li>
        </ul>
        {{--content--}}
        <div class="card--mobile__title">
            <span class="card--back box-account-mobile_open" >
                <a href="/"><img src="/assets/frontend/{{theme('')->theme_key}}/image/icons/back.png" alt=""></a>
            </span>
            <h4>Tin tức</h4>
        </div>
        {{--       Article Slider  --}}
        @include('frontend.pages.article.widget.__slider__bai__viet')
        {{--End--}}


        <div class="row" id="card--body__news">
            <div class="col-12 col-lg-8" id="list-article">
                <div class="card --custom" id="weeky-hot-games">
                    <div class="card--header">
                        <div class="card--header__title">
                            Game hot trong tuần
                        </div>
                    </div>
                    <div class="card--body">
                        <div>
                            <div class="swiper-container swiper-weekly-hot-games">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" >
                                        <a href="javascript:void(0);">
                                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/image_52.png" alt="">
                                        </a>
                                    </div>
                                    <div class="swiper-slide" >
                                        <a href="javascript:void(0);">
                                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/image_52.png" alt="">
                                        </a>
                                    </div>
                                    <div class="swiper-slide" >
                                        <a href="javascript:void(0);">
                                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/image_52.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card --custom p-3 d-none d-lg-block" id="new-article-update">
                    <div class="card--header">
                        <div class="card--header__title">
                            Mới cập nhật
                        </div>
                    </div>
                    <div class="card--body">
                        @if(isset($data) )
                            @foreach($data as $key=> $item)
                                @if($key >= 5)
                        <div class="article px-3">
                            <div class="row">
                                <div class="col-4 col-lg-4 p-0">
                                    <div class="article--thumbnail">
                                        <a href="/tin-tuc/{{ $item->slug }}">
                                            <img onerror="imgError(this)" src="{{\App\Library\MediaHelpers::media($item->image)}}" alt="" class="article--thumbnail__image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-8 col-lg-8 article--info">
                                    <div class="article--title mb-3 mb-lg-0">
                                        <a href="/tin-tuc/{{ $item->slug }}" class="article--title__link">
                                            {{ $item->title }}
                                        </a>
                                    </div>
                                    <div class="article--description d-none d-lg-block">
                                        {!! $item->description !!}
                                    </div>
                                    <div class="article--date">
                                        <i class="__icon calendar mr-2"></i>
                                        {{ formatDateTime($item->created_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                            @endforeach
                        @else
                            <div class="row pb-3 pt-3">
                                <div class="col-md-12 text-center">
                                    <span style="color: red;font-size: 16px;">Không có dữ liệu !</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 left-right justify-content-end default-paginate">
                        @if(isset($data))
                            @if($data->total()>1)
                        <div class="row marinautooo justify-content-center">
                            <div class="col-auto">
                                <div class="data_paginate paging_bootstrap paginations_custom" style="text-align: center">
                                    {{ $data->appends(request()->query())->links('pagination::bootstrap-default-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>

           @include('frontend.widget.__menu__category__article')
        </div>
    </div>
@endsection
