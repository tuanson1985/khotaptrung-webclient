@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head',with(['data'=>$data]))
@endsection
@section('meta_robots')
    <meta name="robots" content="index,follow" />
@endsection
@section('content')
    <section>
        <div class="container">

            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            @if($data == null)
                <div class="item_buy">

                    <div class="container pt-3">
                        <div class="row pb-3 pt-3">
                            <div class="col-md-12 text-center">
                        <span style="color: red;font-size: 16px;">
                            @if(isset($message))
                                {{ $message }}
                            @else
                                Hiện tại không có dữ liệu nào phù hợp với yêu cầu của bạn! Hệ thống cập nhật nick thường xuyên bạn vui lòng theo dõi web trong thời gian tới !
                            @endif
                        </span>
                            </div>
                        </div>

                    </div>

                </div>
            @else
            <nav aria-label="breadcrumb" style="margin-top: 10px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="/mua-acc">Mua acc</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($data->custom->title) ? $data->custom->title :  $data->title }}</li>
                </ol>
            </nav>

            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            <!-- BEGIN: PAGE CONTENT -->
            <!-- BEGIN: BLOG LISTING -->

            <div class="c-content-box c-size-md">
                <div class="container pl-0 pr-0">
                    <div class="article-content content_post">
                        <h1>{{ isset($data->custom->title) ? $data->custom->title :  $data->title }}</h1>
                        <div class="special-text-nick">
                            @if($data->custom->content)
                                {!!  $data->custom->content !!}
                            @else
                                @if(isset($data->content))
                                    {!!  $data->content !!}
                                @else

                                @endif
                            @endif
                        </div>
                        <button id="btn-expand-content-nick" class="expand-button">
                            Xem thêm nội dung
                        </button>

                    </div>
                </div>
                <div class="booking_detail"></div>
                <div class="container pl-0 pr-0">
                    <form class="form-charge form-charge__accountlist">

                        <div class="row" style="width: 100%;margin: 0 auto" id="load_attribute">

                            @include('frontend.pages.account.widget.account_load_attribute_to_filter')

                        </div>

                        <div class="row mb-4" style="padding-top: 16px">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success btn-timkiem " style="position: relative">
                                    Tìm kiếm
                                    <div class="row justify-content-center loading-data__timkiem"></div>
                                </button>
                                <a href="javascript:void(0)" class="btn btn-danger btn-all" style="position: relative">
                                    Tất cả
                                    <div class="row justify-content-center loading-data__timkiem"></div>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container">

                    <div class="row">
                        <div class="col-md-12 col-xs-12 left-right">
                            <div class="row" style="width: 100%;margin: 0 auto">
                                <div class="art-list" style="width: 100%">
                                    <div class="entries" id="account_data">
                                        <div class="body-box-loadding result-amount-loadding">
                                            <div class="d-flex justify-content-center">
                                                <span class="pulser"></span>
                                            </div>
                                        </div>

                                        @include('frontend.pages.account.widget.__datalist')

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END: BLOG LISTING  -->

            <!-- END: PAGE CONTENT -->

            @endif


        </div><!-- /.container -->
    </section>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn-expand-content-nick').on('click', function(e) {

                $('.special-text-nick').toggleClass('-expanded');

                if ($('.special-text-nick').hasClass('-expanded')) {
                    $(this).html('Thu gọn nội dung');
                } else {
                    $(this).html('Xem thêm nội dung');
                }
            });

            $('body').on('click','.nick-checkdangnhap',function(){

                $('#modal-login').modal('show');

            })

        });

    </script>
    <input type="hidden" name="hidden_page" id="hidden_page_service" value="1" />
    <input type="hidden" value="{{ $slug }}" name="slug" class="slug">
    {{--    <input type="hidden" value="{{ $slug_category }}" name="slug_category" class="slug_category">--}}
    <input type="hidden" name="id_data" class="id_data" value="">
    <input type="hidden" name="title_data" class="title_data" value="">
    <input type="hidden" name="price_data" class="price_data" value="">
    <input type="hidden" name="select_data" class="select_data" value="">
    <input type="hidden" name="status_data" class="status_data" value="">
    <input type="hidden" name="sort_by_data" class="sort_by_data" value="">

    <div class="modal fade modal__buyacount loadModal__acount" id="LoadModal" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog__account" role="document">
            <div class="loader" style="text-align: center"><img src="/assets/frontend/{{theme('')->theme_key}}/images/loader.gif" style="width: 50px;height: 50px;display: none"></div>
            <div class="modal-content modal-content_accountlist data__form__random">

            </div>
        </div>
    </div>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/account/buyaccrandom.js?v={{time()}}"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/account/account-list.js?v={{time()}}"></script>
@endsection

