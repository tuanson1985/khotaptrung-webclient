@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head',with(['data'=>$data]))
@endsection
@section('meta_robots')
    <meta name="robots" content="noindex,nofollow"/>
@endsection

<!-- Cookie  -->
@section('styles')
    <link rel="stylesheet" href="/assets/frontend/{{theme('')->theme_key}}/css/modal-custom.css">
@endsection
@php
    if (isset($data->price_old)) {
        $sale_percent = (($data->price_old - $data->price) / $data->price_old) * 100;
        $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
    } else {
        $sale_percent = 0;
    }
@endphp
@php
    $totalaccount = 0;
    if(isset($data->category->items_count)){
        if ((isset($data->category->account_fake) && $data->category->account_fake > 1) || (isset($data->category->custom->account_fake) && $data->category->custom->account_fake > 1)){
            $totalaccount = str_replace(',','.',number_format(round(isset($data->category->custom->account_fake) ? $data->category->items_count*$data->category->custom->account_fake : $data->category->items_count*$data->category->account_fake)));
        }
    }else{
        $totalaccount = 0;
    }
@endphp
@php
    $data_cookie = Cookie::get('viewed_account') ?? '[]';
    $flag_viewed = true;
    $data_cookie = json_decode($data_cookie,true);
        foreach ($data_cookie as $key => $acc_viewed){
            if($acc_viewed['randId'] == $data->randId){
             $flag_viewed = false;
            }
        }
        if ($flag_viewed){
                if (count($data_cookie) >= config('module.acc.viewed.limit_count')) {
                     array_pop($data_cookie);
                 }
                $data_save = [
                    'image'=>$data->image,
                    'category'=>isset($data->category->custom->title) ? $data->category->custom->title :  $data->category->title,
                    'randId'=>$data->randId,
                    'price'=>$data->price,
                    'price_old'=>$data->price_old,
                    'promotion'=>$sale_percent,
                    'buy_account'=>$totalaccount,
                 ];
                array_unshift($data_cookie,$data_save);
                $data_cookie = json_encode($data_cookie);
                Cookie::queue('viewed_account',$data_cookie,43200);
        }
@endphp
@section('content')
    <div class="container c-container" id="account-detail">
        @if($data == null)
            <div class="item_buy">
                <div class="container pt-3">
                    <div class="row pb-3 pt-3">
                        <div class="col-md-12 text-center">
                        <span style="color: red;font-size: 16px;text-align: center">
                            @if(isset($message))
                                {{ $message }}
                            @else

                                Hiện tại không có dữ liệu nào phù hợp với yêu cầu của bạn! Hệ thống cập nhật nick thường
                                xuyên bạn vui lòng theo dõi web trong thời gian tới !
                            @endif
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="data__menuacc">

            </div>

            <div id="showdetailacc">
                {{--        Data detail    --}}
                {{--                @include('frontend.pages.account.widget.__datadetail')--}}
            </div>

            <div id="showslideracc">
                <div class="loading-wrap c-my-24">
                    <span class="modal-loader-spin"></span>
                </div>
                {{--  TK đồng giá   --}}
                {{--                @include('frontend.pages.account.widget.__same__price')--}}
            </div>


            <div>
                {{--            Siêu ưu đã   --}}
                {{--                @include('frontend.pages.account.widget.__flash__sale')--}}

                {{--            Đã xem   --}}
                @include('frontend.pages.account.widget.__viewed__account')
            </div>

            {{--    Modal trả góp   --}}

            <div class="modal fade modal-big modal-tra-gop" id="traGopModal">
                <div class="modal-dialog modal-dialog-centered modal-custom">
                    <div class="modal-content c-p-24">
                        <div class="modal-header">
                            <h2 class="modal-title center">Thông báo</h2>
                            <button type="button" class="close" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body py-0 pl-0 c-pr-8 c-mt-24" id="modal-body-scroll">
                            {{--                            <div class="dialog--content__title fw-500 fz-13 c-mb-12 text-title-theme">--}}
                            {{--                                Thông tin mua thẻ--}}
                            {{--                            </div>--}}
                            <div class="card--gray c-pt-8 c-pb-8 c-pl-12 c-pr-12">
                                <div class="card--attr justify-content-between d-flex c-mb-16 text-center">
                                    <div class="card--attr__value fz-13 fw-500">Tính năng sẽ được cập nhật trong thời
                                        gian tới,bạn vui lòng quay lại sau!
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="modal-footer">--}}
                        {{--                            <button class="btn primary">Xác nhận</button>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>



            <!-- Modal 04 -->
            <div class="modal fade modal-small" id="notInbox">
                <div class="modal-dialog modal-dialog-centered modal-custom">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center p-0">
                            <img class="c-pt-16 c-pb-16"
                                 src="/assets/frontend/{{theme('')->theme_key}}/image/son/tinhnang.svg" alt="">
                        </div>
                        <div class="modal-body text-center c-pl-24 c-pr-24 pt-0 pb-0">

                            <p class="fw-700 fz-15 c-mt-12 mb-0 text-title-theme">Tính năng đang phát triển</p>
                            <p class="fw-400 fz-13 c-mt-10 mb-0">Tính năng này đang được xây dựng và phát triển, bạn vui
                                lòng quay lại sau nha ^^</p>

                        </div>
                        <div class="modal-footer c-p-24">
                            <button class="btn ghost" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 04 -->
            <div class="modal fade modal-small" id="notBuy">
                <div class="modal-dialog modal-dialog-centered modal-custom">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center p-0">
                            <img class="c-pt-16 c-pb-16"
                                 src="/assets/frontend/{{theme('')->theme_key}}/image/son/thatbai.png" alt="">
                        </div>
                        <div class="modal-body text-center c-pl-24 c-pr-24 pt-0 pb-0">
                            <p class="fw-700 fz-15 c-mt-12 mb-0 text-title-theme">Mua thẻ nick thất bại</p>
                            <p class="fw-400 fz-13 c-mt-10 mb-0">Rất tiếc việc mua nick đã thất bại do tài khoản của bạn không đủ, vui lòng nạp tiền để tiếp tục giao dịch!</p>
                        </div>
                        <div class="modal-footer c-p-24">
                            <button type="button" class="btn secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn primary" data-toggle="modal" data-target="#rechargeModal" data-bs-dismiss="modal">Nạp tiền</button>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($game_auto_props) && count($game_auto_props))
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
            <!-- Modal Tướng -->
                <div class="modal fade show modal-lmht" id="modal-champ" aria-modal="true">
                    <div class="modal-dialog modal-dialog-centered animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="d-block d-lg-flex w-100">
                                    <div class="modal-title w-auto">Tướng ({{ $total_tuong??0 }} tướng)</div>
                                    <form action="" class="form-search-modal c-ml-16 c-ml-lg-0">
                                        <input type="text" class="input-primary" placeholder="Tìm kiếm...">
                                        <button class="btn -primary d-none d-lg-inline-block" type="submit"></button>
                                    </form>
                                </div>
                                <button type="button" class="close" data-dismiss="modal"></button>
                            </div>
                            <div class="modal-body px-0">
                                <div class="text-invalid text-center">Không tìm thấy kết quả nào !</div>
                                <div class="row">
                                    @foreach($game_auto_props as $game_auto_prop)
                                        @if($game_auto_prop->key == 'champions')
                                            <div class="col-lg-2 col-6">
                                                <div class="card card-lmht">
                                                    <div class="card-thumb">
                                                        <img data-src="https://backend.dev.tichhop.pro/{{ $game_auto_prop->thumb }}" alt="" class="card-thumb-image lazy">
                                                    </div>
                                                    <div class="card-name">
                                                        {{ $game_auto_prop->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Skin -->
                <div class="modal fade show modal-lmht" id="modal-skin" aria-modal="true">
                    <div class="modal-dialog modal-dialog-centered animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="d-block d-lg-flex w-100">
                                    <div class="modal-title w-auto">Trang phục ({{ $total_trangphuc }} Trang phục)</div>
                                    <form action="" class="form-search-modal c-ml-16 c-ml-lg-0">
                                        <input type="text" class="input-primary" placeholder="Tìm kiếm...">
                                        <button class="btn -primary d-none d-lg-inline-block" type="submit"></button>
                                    </form>
                                </div>
                                <button type="button" class="close" data-dismiss="modal"></button>
                            </div>
                            <div class="modal-body px-0">
                                <div class="text-invalid text-center">Không tìm thấy kết quả nào !</div>
                                <div class="row">
                                    @foreach($game_auto_props as $game_auto_prop)
                                        @if($game_auto_prop->key == 'champions')
                                            @if(isset($game_auto_prop->childs) && count($game_auto_prop->childs))
                                                @foreach($game_auto_prop->childs as $c_child)
                                                    <div class="col-lg-2 col-6">
                                                        <div class="card card-lmht">
                                                            <div class="card-thumb">
                                                                <img data-src="{{\App\Library\MediaHelpers::media($c_child->thumb)}}" alt="Icon Skin" class="card-thumb-image lazy">
                                                            </div>
                                                            <div class="card-name">
                                                                {{ $c_child->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Animal -->
                <div class="modal fade show modal-lmht" id="modal-animal" aria-modal="true">
                    <div class="modal-dialog modal-dialog-centered animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="d-block d-lg-flex w-100">
                                    <div class="modal-title w-auto">Linh thú TFT ({{ $total_linhthu }} linh thú)</div>
                                    <form action="" class="form-search-modal c-ml-16 c-ml-lg-0">
                                        <input type="text" class="input-primary" placeholder="Tìm kiếm...">
                                        <button class="btn -primary d-none d-lg-inline-block" type="submit"></button>
                                    </form>
                                </div>
                                <button type="button" class="close" data-dismiss="modal"></button>
                            </div>
                            <div class="modal-body px-0">
                                <div class="text-invalid text-center">Không tìm thấy kết quả nào !</div>
                                <div class="row">
                                    @foreach($game_auto_props as $game_auto_prop)
                                        @if($game_auto_prop->key == 'tftcompanions')
                                            <div class="col-lg-2 col-6">
                                                <div class="card card-lmht">
                                                    <div class="card-thumb">
                                                        <img data-src="{{\App\Library\MediaHelpers::media($game_auto_prop->thumb)}}" alt="Icon Animal" class="card-thumb-image lazy">
                                                    </div>
                                                    <div class="card-name">
                                                        {{ $game_auto_prop->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <input type="hidden" name="slug" class="slug" value="{{ $slug }}">

            <input type="hidden" name="slug" class="slug_category" value="{{ $slug_category }}">

            <script src="/assets/frontend/{{theme('')->theme_key}}/js/nick/buyacc.js"></script>
            <script src="/assets/frontend/{{theme('')->theme_key}}/js/nick/buyaccslider.js"></script>
        @endif
    </div>



@endsection

@section('scripts')
    <script>
        $('body').on('click', '#account-detail .btn-muangay', function (e) {
            e.preventDefault();
            $('#orderModal').modal('show');
        })

        $('body').on('click', '#account-detail .btn-muangay-not', function (e) {
            e.preventDefault();

            $('#orderModalNot').modal('show');
        })

        $('body').on('click', '#account-detail .btn-tragop', function (e) {
            e.preventDefault();
            $('#traGopModal').modal('show');
        })

        $('body').on('click', '#account-detail .btn-show-tuong', function (e) {
            e.preventDefault();
            $('.c-modal__nick-lmht-tuong').css('display', 'block');
        })

        $('body').on('click', '.c-close-modal', function (e) {
            e.preventDefault();
            $('.c-modal__nick-lmht-tuong').css('display', 'none');
            $('.c-modal__nick-lmht-trang-phuc').css('display', 'none');
            $('.c-modal__nick-lmht-ttk').css('display', 'none');
        })

        $('body').on('click', '#account-detail .btn-trangphuc', function (e) {
            e.preventDefault();
            $('.c-modal__nick-lmht-trang-phuc').css('display', 'block');
        })

        $('body').on('click', '#account-detail .btn-thongtinkhac', function (e) {
            e.preventDefault();
            $('.c-modal__nick-lmht-ttk').css('display', 'block');
        })

        $('body').on('click', '#account-detail .btn-success-mobile', function (e) {
            e.preventDefault();
            $('#orderSuccses').modal('show');
        })
    </script>
@endsection


