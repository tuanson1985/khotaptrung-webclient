@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head',with(['data'=>$data]))
@endsection
@section('meta_robots')
    <meta name="robots" content="noindex,nofollow" />
@endsection
@section('styles')

@endsection
@section('content')

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

        @php
            $total_tuong = 0;
            $total_bieucam = 0;
            $total_chuongluc = 0;
            $total_sandau = 0;
            $total_linhthu = 0;
            $total_trangphuc = 0;
            $total_thongtinchung = 0;

            if(isset($game_auto_props) && count($game_auto_props)){
                foreach($game_auto_props as $game_auto_prop){
                    if($game_auto_prop->key == 'champions'){
                        $total_tuong = $total_tuong + 1;
                        if(isset($game_auto_prop->childs) && count($game_auto_prop->childs)){
                            foreach($game_auto_prop->childs as $c_child){
                                $total_trangphuc = $total_trangphuc + 1;
                            }
                        }
                    }elseif ($game_auto_prop->key == 'emotes'){
                        $total_bieucam = $total_bieucam + 1;
                    }elseif ($game_auto_prop->key == 'tftdamageskins'){
                        $total_chuongluc = $total_chuongluc + 1;
                    }elseif ($game_auto_prop->key == 'tftmapskins'){
                        $total_sandau = $total_sandau + 1;
                    }elseif ($game_auto_prop->key == 'tftcompanions'){
                        $total_linhthu = $total_linhthu + 1;
                    }
                }
            }
        @endphp

        <div class="not__data shop_product_detailS">
            <div class="news_breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-12 data__menuacc">

                        </div>
                    </div>
                </div>
            </div>

            <div class="container pt-3 fixcssacount">
                <div class="row container__show">

                    <div class="col-md-12 left-right" id="showdetailacc">
                        <div class="body-box-loadding result-amount-loadding">
                            <div class="d-flex justify-content-center" style="padding-top: 112px;">
                                <span class="pulser"></span>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div class="row container__show">--}}
{{--                    <div class="col-md-12 left-right">--}}
{{--                        @if(isset($data->category->custom->slug) ? $data->category->custom->slug == 'nick-lien-minh' :  $data->category->slug == 'nick-lien-minh')--}}
{{--                            <div class="row marginauto data__chitietnick">--}}
{{--                                <div class="col-md-12 left-right" id="">--}}
{{--                                    <div class="shop_product_another pt-3">--}}
{{--                                        <div class="c-content-title-1">--}}
{{--                                            <h3 class="c-center c-font-uppercase c-font-bold title__tklienquan">Chi tiết Nick</h3>--}}
{{--                                            <div class="c-line-center c-theme-bg"></div>--}}
{{--                                        </div>--}}

{{--                                        <div class="description_product">--}}

{{--                                            <ul class="nav nav-tab-booking" role="tablist" style="">--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item active" data-toggle="tab" href="#acc_info" role="tab"  >--}}
{{--                                                        Thông tin--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item " data-toggle="tab" href="#champions-tab" role="tab"  >--}}
{{--                                                        Tướng--}}

{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item " data-toggle="tab" href="#acc_costume" role="tab"  >--}}
{{--                                                        Trang phục--}}

{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item " data-toggle="tab" href="#acc_color" role="tab"  >--}}
{{--                                                        Đa sắc--}}

{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item " data-toggle="tab" href="#tftcompanions-tab" role="tab"  >--}}
{{--                                                        Linh thú TFT--}}

{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item " data-toggle="tab" href="#tftdamageskins-tab" role="tab"  >--}}
{{--                                                        Sân đấu TFT--}}

{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li role="presentation" class="" >--}}
{{--                                                    <a  class="nav-item " data-toggle="tab" href="#tftmapskins-tab" role="tab"  >--}}
{{--                                                        Chưởng lực TFT--}}

{{--                                                    </a>--}}
{{--                                                </li>--}}

{{--                                            </ul>--}}
{{--                                            <div class="tab-content">--}}
{{--                                                <div class="tab-pane  fade show active" id="acc_info">--}}

{{--                                                </div>--}}
{{--                                                <div class="tab-pane  fade show" id="champions-tab">--}}
{{--                                                    <div class="acc_search" style="padding-top: 12px">--}}
{{--                                                        <input type="text" class="form-control m-b-20" placeholder="Tìm kiếm">--}}

{{--                                                    </div>--}}
{{--                                                    <div class="row m-0" id="champions-list">--}}
{{--                                                        <div class="costume_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="costume_item_detail">--}}
{{--                                                                <a data-fancybox="champions-list" href="/assets/frontend/theme_1/images/trangphuc.jpg">--}}
{{--                                                                    <div class="costume_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/trangphuc.jpg" alt="">--}}
{{--                                                                        <span class="costume_title">--}}
{{--                                                            Annie Quàng Khăn Đỏ--}}
{{--                                                        </span>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="costume_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="costume_item_detail">--}}
{{--                                                                <a data-fancybox="champions-list" href="/assets/frontend/theme_1/images/trangphuc.jpg">--}}
{{--                                                                    <div class="costume_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/trangphuc.jpg" alt="">--}}
{{--                                                                        <span class="costume_title">--}}
{{--                                                            Annie Quàng Khăn Đỏ--}}
{{--                                                        </span>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="costume_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="costume_item_detail">--}}
{{--                                                                <a data-fancybox="champions-list" href="/assets/frontend/theme_1/images/trangphuc.jpg">--}}
{{--                                                                    <div class="costume_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/trangphuc.jpg" alt="">--}}
{{--                                                                        <span class="costume_title">--}}
{{--                                                            Annie Quàng Khăn Đỏ--}}
{{--                                                        </span>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="tab-pane  fade show " id="acc_costume">--}}
{{--                                                    <div class="acc_search" style="padding-top: 12px">--}}
{{--                                                        <input type="text" class="form-control m-b-20" placeholder="Tìm kiếm">--}}

{{--                                                    </div>--}}
{{--                                                    <div class="row m-0" id="acc_costume_list">--}}
{{--                                                        <div class="generals_item col-lg-3 col-md-4 col-4 p-8">--}}
{{--                                                            <a data-fancybox="acc_costume_list" href="/assets/frontend/theme_1/images/tuong.png">--}}
{{--                                                                <div class="generals_image">--}}
{{--                                                                    <img src="/assets/frontend/theme_1/images/tuong.png" alt="">--}}
{{--                                                                    <span class="generals_title">--}}
{{--                                                           Galio--}}
{{--                                                    </span>--}}
{{--                                                                </div>--}}

{{--                                                            </a>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="generals_item col-lg-3 col-md-4 col-4 p-8">--}}
{{--                                                            <a data-fancybox="acc_costume_list" href="/assets/frontend/theme_1/images/tuong.png">--}}
{{--                                                                <div class="generals_image">--}}
{{--                                                                    <img src="/assets/frontend/theme_1/images/tuong.png" alt="">--}}
{{--                                                                    <span class="generals_title">--}}
{{--                                                           Galio--}}
{{--                                                    </span>--}}
{{--                                                                </div>--}}

{{--                                                            </a>--}}
{{--                                                        </div>--}}




{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="tab-pane  fade show " id="acc_color">--}}
{{--                                                    <div class="acc_search" style="padding-top: 12px">--}}
{{--                                                        <input type="text" class="form-control m-b-20" placeholder="Tìm kiếm">--}}

{{--                                                    </div>--}}
{{--                                                    <div class="row m-0" id="acc_color_list">--}}
{{--                                                        <div class="costume_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="costume_item_detail">--}}
{{--                                                                <a data-fancybox="acc_color_list" href="/assets/frontend/theme_1/images/dasac.png">--}}
{{--                                                                    <div class="costume_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/dasac.png" alt="">--}}
{{--                                                                        <span class="costume_title">--}}
{{--                                                           Fiddlesticks Tướng Cướp--}}

{{--                                                        </span>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="costume_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="costume_item_detail">--}}
{{--                                                                <a data-fancybox="acc_color_list" href="/assets/frontend/theme_1/images/dasac2.png">--}}
{{--                                                                    <div class="costume_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/dasac2.png" alt="">--}}
{{--                                                                        <span class="costume_title">--}}
{{--                                                           Fiddlesticks Tướng Cướp--}}

{{--                                                        </span>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="costume_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="costume_item_detail">--}}
{{--                                                                <a data-fancybox="acc_color_list" href="/assets/frontend/theme_1/images/dasac3.png">--}}
{{--                                                                    <div class="costume_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/dasac3.png" alt="">--}}
{{--                                                                        <span class="costume_title">--}}
{{--                                                           Fiddlesticks Tướng Cướp--}}

{{--                                                        </span>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}


{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="tab-pane  fade show" id="tftcompanions-tab">--}}
{{--                                                    <div class="acc_search" style="padding-top: 12px">--}}
{{--                                                        <input type="text" class="form-control m-b-20" placeholder="Tìm kiếm">--}}

{{--                                                    </div>--}}
{{--                                                    <div class="row m-0" id="tftcompanions_list">--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftcompanions_list" href="/assets/frontend/theme_1/images/linhthu.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/linhthu.png" alt="">--}}

{{--                                                                    </div>--}}
{{--                                                                    <div class="skin_title">--}}
{{--                                                                        Fiddlesticks Tướng Cướp--}}

{{--                                                                    </div>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftcompanions_list" href="/assets/frontend/theme_1/images/linhthu.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/linhthu.png" alt="">--}}

{{--                                                                    </div>--}}
{{--                                                                    <div class="skin_title">--}}
{{--                                                                        Fiddlesticks Tướng Cướp--}}

{{--                                                                    </div>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftcompanions_list" href="/assets/frontend/theme_1/images/linhthu3.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/linhthu3.png" alt="">--}}

{{--                                                                    </div>--}}
{{--                                                                    <div class="skin_title">--}}
{{--                                                                        Fiddlesticks Tướng Cướp--}}

{{--                                                                    </div>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftcompanions_list" href="/assets/frontend/theme_1/images/linhthu2.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/linhthu2.png" alt="">--}}

{{--                                                                    </div>--}}
{{--                                                                    <div class="skin_title">--}}
{{--                                                                        Fiddlesticks Tướng Cướp--}}

{{--                                                                    </div>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}



{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="tab-pane  fade show" id="tftdamageskins-tab">--}}
{{--                                                    <div class="acc_search" style="padding-top: 12px">--}}
{{--                                                        <input type="text" class="form-control m-b-20" placeholder="Tìm kiếm">--}}

{{--                                                    </div>--}}
{{--                                                    <div class="row m-0" id="tftdamageskins_list">--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftdamageskins_list" href="/assets/frontend/theme_1/images/sandau.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/sandau.png" alt="">--}}
{{--                                                                        <div class="mapskin_title">--}}
{{--                                                                            Fiddlesticks Tướng Cướp--}}

{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftdamageskins_list" href="/assets/frontend/theme_1/images/sandau2.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/sandau2.png" alt="">--}}
{{--                                                                        <div class="mapskin_title">--}}
{{--                                                                            Fiddlesticks Tướng Cướp--}}

{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftdamageskins_list" href="/assets/frontend/theme_1/images/sandau3.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/sandau3.png" alt="">--}}
{{--                                                                        <div class="mapskin_title">--}}
{{--                                                                            Fiddlesticks Tướng Cướp--}}

{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}



{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="tab-pane  fade show" id="tftmapskins-tab">--}}
{{--                                                    <div class="acc_search" style="padding-top: 12px">--}}
{{--                                                        <input type="text" class="form-control m-b-20 fixcssacount" placeholder="Tìm kiếm">--}}

{{--                                                    </div>--}}
{{--                                                    <div class="row m-0" id="tftmapskins_list">--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftmapskins_list" href="/assets/frontend/theme_1/images/damdon.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/damdon.png" alt="">--}}
{{--                                                                        <div class="mapskin_title">--}}
{{--                                                                            Fiddlesticks Tướng Cướp--}}

{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftmapskins_list" href="/assets/frontend/theme_1/images/damdon.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/damdon.png" alt="">--}}
{{--                                                                        <div class="mapskin_title">--}}
{{--                                                                            Fiddlesticks Tướng Cướp--}}

{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="skin_item col-lg-3 col-md-4 col-6 fixcssacount">--}}
{{--                                                            <div class="skin_item_detail">--}}
{{--                                                                <a data-fancybox="tftmapskins_list" href="/assets/frontend/theme_1/images/damdon.png">--}}
{{--                                                                    <div class="skin_image">--}}
{{--                                                                        <img src="/assets/frontend/theme_1/images/damdon.png" alt="">--}}
{{--                                                                        <div class="mapskin_title">--}}
{{--                                                                            Fiddlesticks Tướng Cướp--}}

{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}




{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        @if(isset($data->description))--}}
{{--                            <div class="shop_product_another">--}}
{{--                                <div class="c-content-title-1">--}}
{{--                                    <h3 class="c-center c-font-uppercase c-font-bold title__tklienquan">CHI TIẾT</h3>--}}
{{--                                    <div class="c-line-center c-theme-bg"></div>--}}
{{--                                </div>--}}

{{--                                <div class="shop_product_another_content">--}}
{{--                                    <div class="item_buy_list row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <span>{!! $data->description !!}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="row marginauto">
                    <div class="col-md-12 left-right" id="showslideracc">
                        <div class="body-box-loadding result-amount-loadding result-amount-loadding__nick-lien-quan">
                            <div class="d-flex justify-content-center" style="padding-top: 112px;">
                                <span class="pulser"></span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" name="slug" class="slug" value="{{ $slug }}">

        <input type="hidden" name="slug" class="slug_category" value="{{ $slug_category }}">
        @if(isset($game_auto_props) && count($game_auto_props))
        {{--    Modal Biểu cảm   --}}

{{--        <div class="c-modal__nick-lmht c-modal__nick-lmht-bieu-cam" id="nick-lmht-bieucam" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">--}}
{{--            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">--}}
{{--                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">--}}
{{--                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">--}}
{{--                        <h2 class="fw-700 fz-24 lh-32 mb-0">Biểu cảm</h2>--}}
{{--                        <p class="fw-400 fz-13 lh-20 mb-0">({{ $total_bieucam }} Biểu cảm)</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">--}}
{{--                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht">--}}
{{--                        <button class="submit--search" type="submit"></button>--}}
{{--                    </div>--}}
{{--                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">--}}
{{--                <div class="row marginauto modal-container-body">--}}
{{--                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">--}}
{{--                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>--}}
{{--                    </div>--}}

{{--                    @foreach($game_auto_props as $game_auto_prop)--}}
{{--                        @if($game_auto_prop->key == 'emotes')--}}
{{--                            <div class="col-auto c-px-6 c-py-8 item-nick-lmht">--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    <div class="row marginauto item-nick-lmht__border">--}}
{{--                                        <div class="col-md-12 pl-0 pr-0 item-nick-lmht__border__col">--}}
{{--                                            <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" alt="{{ $game_auto_prop->name }}" src="{{\App\Library\MediaHelpers::media($game_auto_prop->thumb)}}" alt="Axtrox">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 pl-0 pr-0 text-center">--}}
{{--                                            <p class="fw-400 fz-13 c-mb-4 c-mt-20 text-theme text-limit limit-1">{{ $game_auto_prop->name }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--                <div class="modal-footer" style="height: 16px">--}}

{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

        {{--    Modal Chưởng lực TFT   --}}

{{--        <div class="c-modal__nick-lmht c-modal__nick-lmht-chuong-luc-tft" id="nick-lmht-chuongluc" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">--}}
{{--            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">--}}
{{--                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">--}}
{{--                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">--}}
{{--                        <h2 class="fw-700 fz-24 lh-32 mb-0">Chưởng lực TFT</h2>--}}

{{--                        <p class="fw-400 fz-13 lh-20 mb-0">({{ $total_chuongluc }} chưởng lực)</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">--}}
{{--                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht">--}}
{{--                        <button class="submit--search" type="submit"></button>--}}
{{--                    </div>--}}
{{--                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">--}}
{{--                <div class="row marginauto modal-container-body">--}}
{{--                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">--}}
{{--                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>--}}
{{--                    </div>--}}

{{--                    @foreach($game_auto_props as $game_auto_prop)--}}
{{--                        @if($game_auto_prop->key == 'tftdamageskins')--}}
{{--                            <div class="col-auto c-px-6 c-py-8 item-nick-lmht">--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    <div class="row marginauto item-nick-lmht__border">--}}
{{--                                        <div class="col-md-12 pl-0 pr-0 item-nick-lmht__border__col">--}}
{{--                                            <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" alt="{{ $game_auto_prop->name }}" src="{{\App\Library\MediaHelpers::media($game_auto_prop->thumb)}}" alt="Axtrox">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 pl-0 pr-0 text-center">--}}
{{--                                            <p class="fw-400 fz-13 c-mb-4 c-mt-20 text-theme text-limit limit-1">{{ $game_auto_prop->name }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}


{{--                </div>--}}
{{--                <div class="modal-footer" style="height: 16px">--}}

{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

        {{--    Modal Sàn đấu tft   --}}

{{--        <div class="c-modal__nick-lmht c-modal__nick-lmht-san-dau-tft" id="nick-lmht-sandau" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">--}}
{{--            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">--}}
{{--                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">--}}
{{--                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">--}}
{{--                        <h2 class="fw-700 fz-24 lh-32 mb-0">Sàn đấu TFT</h2>--}}
{{--                        <p class="fw-400 fz-13 lh-20 mb-0">({{ $total_sandau }} sàn đấu)</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">--}}
{{--                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht">--}}
{{--                        <button class="submit--search" type="submit"></button>--}}
{{--                    </div>--}}
{{--                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">--}}
{{--                <div class="row marginauto modal-container-body">--}}
{{--                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">--}}
{{--                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>--}}
{{--                    </div>--}}

{{--                    @foreach($game_auto_props as $game_auto_prop)--}}
{{--                        @if($game_auto_prop->key == 'tftmapskins')--}}
{{--                            <div class="col-auto c-px-6 c-py-8 item-nick-lmht">--}}
{{--                                <a href="javascript:void(0)">--}}
{{--                                    <div class="row marginauto item-nick-lmht__border">--}}
{{--                                        <div class="col-md-12 pl-0 pr-0 item-nick-lmht__border__col">--}}
{{--                                            <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" alt="{{ $game_auto_prop->name }}" src="{{\App\Library\MediaHelpers::media($game_auto_prop->thumb)}}" alt="Axtrox">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 pl-0 pr-0 text-center">--}}
{{--                                            <p class="fw-400 fz-13 c-mb-4 c-mt-20 text-theme text-limit limit-1">{{ $game_auto_prop->name }}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}

{{--                </div>--}}
{{--                <div class="modal-footer" style="height: 16px">--}}

{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

        {{--    Modal Linh thú tft   --}}

        <div class="c-modal__nick-lmht c-modal__nick-lmht-linh-thu-tft d-none" id="nick-lmht-linhthu" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">
            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">
                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">
                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">
                        <h2 class="fw-700 fz-24 lh-32 mb-0">Linh thú TFT</h2>

                        <p class="fw-400 fz-13 lh-20 mb-0">({{ $total_linhthu }} linh thú)</p>
                    </div>
                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">
                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht form-control">
                        <button class="submit--search" type="submit"></button>
                    </div>
                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">
                </div>
            </div>
            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">
                <div class="row marginauto modal-container-body">
                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">
                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>
                    </div>

                    @foreach($game_auto_props as $game_auto_prop)
                        @if($game_auto_prop->key == 'tftcompanions')
                            <div class="col-auto c-px-6 c-py-8 item-nick-lmht">
                                <a href="javascript:void(0)">
                                    <div class="row marginauto item-nick-lmht__border">
                                        <div class="col-md-12 pl-0 pr-0 item-nick-lmht__border__col">
                                            <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" src="{{\App\Library\MediaHelpers::media($game_auto_prop->thumb)}}" alt="{{ $game_auto_prop->name }}">
                                        </div>
                                        <div class="col-md-12 pl-0 pr-0 text-center">
                                            <p class="fw-400 fz-13 c-mb-4 c-mt-20 text-theme text-limit limit-1">{{ $game_auto_prop->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="modal-footer" style="height: 16px">

                </div>
            </div>

        </div>

        {{--    Modal Trang phuc   --}}

        <div class="c-modal__nick-lmht c-modal__nick-lmht-trang-phuc d-none" id="nick-lmht-trangphuc" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">
            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">
                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">
                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">
                        <h2 class="fw-700 fz-24 lh-32 mb-0">Trang phục</h2>
                        <p class="fw-400 fz-13 lh-20 mb-0">({{ $total_trangphuc }} Trang phục)</p>
                    </div>
                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">
                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht form-control">
                        <button class="submit--search" type="submit"></button>
                    </div>
                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">
                </div>
            </div>
            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">
                <div class="row marginauto modal-container-body">
                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">
                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>
                    </div>

                    @foreach($game_auto_props as $game_auto_prop)
                        @if($game_auto_prop->key == 'champions')
                            @if(isset($game_auto_prop->childs) && count($game_auto_prop->childs))
                                @foreach($game_auto_prop->childs as $c_child)
                                <div class="col-auto c-px-6 c-py-8 item-nick-lmht">
                                    <a href="javascript:void(0)">
                                        <div class="row marginauto item-nick-lmht__border">
                                            <div class="col-md-12 pl-0 pr-0 item-nick-lmht__border__col">
                                                <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" src="{{\App\Library\MediaHelpers::media($c_child->thumb)}}" alt="{{ $c_child->name }}">
                                            </div>
                                            <div class="col-md-12 pl-0 pr-0 text-center">
                                                <p class="fw-400 fz-13 c-mb-4 c-mt-20 text-theme text-limit limit-1">{{ $c_child->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            @endif
                        @endif
                    @endforeach

                </div>
                <div class="modal-footer" style="height: 16px">

                </div>
            </div>

        </div>


        {{--    Modal Tuong   --}}

        <div class="c-modal__nick-lmht c-modal__nick-lmht-tuong d-none d-none" id="nick-lmht-tuong" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">
            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">
                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">
                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">
                        <h2 class="fw-700 fz-24 lh-32 mb-0">Tướng</h2>
                        <p class="fw-400 fz-13 lh-20 mb-0 total_tuong_data">({{ $total_tuong??0 }} tướng)</p>
                    </div>
                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">
                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht form-control">
                        <button class="submit--search" type="submit"></button>
                    </div>
                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">
                </div>
            </div>
            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">
                <div class="row marginauto modal-container-body">
                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">
                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>
                    </div>
                    @foreach($game_auto_props as $game_auto_prop)
                        @if($game_auto_prop->key == 'champions')
                            <div class="col-auto c-px-6 c-py-8 item-nick-lmht">
                                <a href="javascript:void(0)">
                                    <div class="row marginauto item-nick-lmht__border">
                                        <div class="col-md-12 pl-0 pr-0 item-nick-lmht__border__col">
                                            <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" src="https://backend.dev.tichhop.pro/{{ $game_auto_prop->thumb }}" alt="{{ $game_auto_prop->name }}">
{{--                                            <img class="w-100 brs-4 position-absolute item-nick-lmht__border__img lazy" src="{{\App\Library\MediaHelpers::media($game_auto_prop->thumb)}}" alt="{{ $game_auto_prop->name }}">--}}
                                        </div>
                                        <div class="col-md-12 pl-0 pr-0 text-center">
                                            <p class="fw-400 fz-13 c-mt-10 text-theme text-limit limit-1" style="padding-top: 8px;margin-bottom: 0">{{ $game_auto_prop->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
                <div class="modal-footer" style="height: 16px">

                </div>
            </div>

        </div>

        {{--    Modal thông tin khác--}}

{{--        <div class="c-modal__nick-lmht c-modal__nick-lmht-ttk c-modal-ttchung d-none" id="nick-lmht-thongtinchung" style="z-index: 1005; background: rgba(67, 70, 87, 0.5);">--}}
{{--            <div class="header-modal__nick-lmht c-px-24 c-pt-24 pb-0 position-relative text-uppercase text-center ml-auto mr-auto fw-700">--}}
{{--                <div class="row marginauto c-pb-24 header-modal__nick-lmht-row">--}}
{{--                    <div class="col-auto pl-0 pr-0 mb-0 c-mr-24">--}}
{{--                        <h2 class="fw-700 fz-24 lh-32 mb-0">Thông tin khác</h2>--}}
{{--                        <p class="fw-400 fz-13 lh-20 mb-0">(10)</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto pl-0 pr-0 form-search input-search-lmht position-relative">--}}
{{--                        <input id="keyword--search" type="search" placeholder="Tìm kiếm" class="has-submit input-search-lmht">--}}
{{--                        <button class="submit--search" type="submit"></button>--}}
{{--                    </div>--}}
{{--                    <img class="c-close-modal" src="/assets/frontend/{{theme('')->theme_key}}/image/son/close.svg" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="body-modal__nick-lmht pb-0 c-px-18 c-pt-10 mr-auto ml-auto">--}}
{{--                <div class="row marginauto modal-container-body">--}}
{{--                    <div class="col-md-12 c-px-6 c-py-8 body-modal__nick__text-error">--}}
{{--                        <div class="text-error c-mt-4">Không có kết quả phù hợp.</div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 pl-0 pr-0 c-px-6 c-py-8">--}}
{{--                        <a href="">--}}
{{--                            <div class="row marginauto">--}}
{{--                                <div class="col-md-12 pl-0 pr-0">--}}
{{--                                    <img class="w-100 h-auto brs-4" src="/assets/frontend/{{theme('')->theme_key}}/image/son/test.png" alt="Axtrox">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 pl-0 pr-0 c-px-6 c-py-8">--}}
{{--                        <a href="">--}}
{{--                            <div class="row marginauto">--}}
{{--                                <div class="col-md-12 pl-0 pr-0">--}}
{{--                                    <img class="w-100 h-auto brs-4" src="/assets/frontend/{{theme('')->theme_key}}/image/son/test.png" alt="Axtrox">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 pl-0 pr-0 c-px-6 c-py-8">--}}
{{--                        <a href="">--}}
{{--                            <div class="row marginauto">--}}
{{--                                <div class="col-md-12 pl-0 pr-0">--}}
{{--                                    <img class="w-100 h-auto brs-4" src="/assets/frontend/{{theme('')->theme_key}}/image/son/test.png" alt="Axtrox">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-12 pl-0 pr-0 c-px-6 c-py-8">--}}
{{--                        <a href="">--}}
{{--                            <div class="row marginauto">--}}
{{--                                <div class="col-md-12 pl-0 pr-0">--}}
{{--                                    <img class="w-100 h-auto brs-4" src="/assets/frontend/{{theme('')->theme_key}}/image/son/test.png" alt="Axtrox">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer" style="height: 16px">--}}

{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}


        <input type="hidden" name="total_tuong" class="total_tuong" value="{{ $total_tuong }}">
{{--        <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/son/main.css">--}}
        <script>
            $('body').on('click','.c-close-modal',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-tuong').addClass('d-none');
                $('.c-modal__nick-lmht-ttk').addClass('d-none');
                $('.c-modal__nick-lmht-trang-phuc').addClass('d-none');
                $('.c-modal__nick-lmht-linh-thu-tft').addClass('d-none');
                $('.c-modal__nick-lmht-san-dau-tft').addClass('d-none');
                $('.c-modal__nick-lmht-chuong-luc-tft').addClass('d-none');

                $('.c-modal__nick-lmht-bieu-cam').addClass('d-none');
            });


            $('body').on('click','.lm_xemthem_tuong',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-tuong').removeClass('d-none');
            });

            $('body').on('click','.lm_xemthem_thongtinchung',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-ttk').removeClass('d-none');
            });

            $('body').on('click','.lm_xemthem_trangphuc',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-trang-phuc').removeClass('d-none');
            });

            $('body').on('click','.lm_xemthem_linhthu',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-linh-thu-tft').removeClass('d-none');
            });

            $('body').on('click','.lm_xemthem_sandau',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-san-dau-tft').removeClass('d-none');
            });

            $('body').on('click','.lm_xemthem_damedondanh',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-chuong-luc-tft').removeClass('d-none');
            });

            $('body').on('click','.lm_xemthem_bieucam',function(e){
                e.preventDefault();
                $('.c-modal__nick-lmht-bieu-cam').removeClass('d-none');
            });

            $('body').on('click','#nick-lmht-tuong  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-tuong #keyword--search').val());

                let index = 0;
                $('#nick-lmht-tuong .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-tuong  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-tuong  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })

            $('body').on('click','#nick-lmht-trangphuc  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-trangphuc #keyword--search').val());

                let index = 0;
                $('#nick-lmht-trangphuc .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-trangphuc  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-trangphuc  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })

            $('body').on('click','#nick-lmht-thongtinchung  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-thongtinchung #keyword--search').val());

                let index = 0;
                $('#nick-lmht-thongtinchung .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-thongtinchung  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-thongtinchung  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })

            $('body').on('click','#nick-lmht-linhthu  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-linhthu #keyword--search').val());

                let index = 0;
                $('#nick-lmht-linhthu .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-linhthu  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-linhthu  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })

            $('body').on('click','#nick-lmht-sandau  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-sandau #keyword--search').val());

                let index = 0;
                $('#nick-lmht-sandau .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-sandau  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-sandau  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })

            $('body').on('click','#nick-lmht-bieucam  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-bieucam #keyword--search').val());

                let index = 0;
                $('#nick-lmht-bieucam .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-bieucam  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-bieucam  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })

            $('body').on('click','#nick-lmht-chuongluc  .submit--search',function(e){
                e.preventDefault();
                let keyword = convertToSlug($('#nick-lmht-chuongluc #keyword--search').val());

                let index = 0;
                $('#nick-lmht-chuongluc .item-nick-lmht').each(function (i,elm) {
                    $('#nick-lmht-chuongluc  .body-modal__nick__text-error').css('display','none');
                    let slug_item = $(elm).find('img').attr('alt');
                    slug_item = convertToSlug(slug_item);
                    $(this).toggle(slug_item.indexOf(keyword) > -1);
                    if (slug_item.indexOf(keyword) > -1){
                        index = index + 1
                    }else {}

                    if (index == 0){
                        $('#nick-lmht-chuongluc  .body-modal__nick__text-error').css('display','block');
                    }

                })
            })


            function convertToSlug(title) {
                var slug;
                //Đổi chữ hoa thành chữ thường
                slug = title.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                // trả về kết quả
                return slug;
            }

        </script>
        @endif
        <script src="/assets/frontend/{{theme('')->theme_key}}/js/js_trong/modal-charge.js?v={{time()}}"></script>
        <script src="/assets/frontend/{{theme('')->theme_key}}/js/transfer/transfer.js?v={{time()}}"></script>
        <script src="/assets/frontend/{{theme('')->theme_key}}/js/account/buyacc.js"></script>
        <script src="/assets/frontend/{{theme('')->theme_key}}/js/account/buyaccslider.js"></script>
{{--        <script src="/js/{{theme('')->theme_key}}/account/detail.js"></script>--}}
        <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/modal-custom.css">
{{--        <link rel="stylesheet" href="/css/{{theme('')->theme_key}}/account/detail.css">--}}
        {{--    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/modal-custom.css">--}}


    @endif
@endsection

