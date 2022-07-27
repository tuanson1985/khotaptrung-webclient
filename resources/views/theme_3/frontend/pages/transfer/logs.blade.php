@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('content')

    {{--  Menu  --}}
    <section class="media-web">
        <div class="container container-fix menu-container-ct">
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li class="menu-container-li-ct"><img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/arrow-right.png" alt=""></li>
                <li class="menu-container-li-ct"><a href="/lich-su-giao-dich">Lịch sử giao dịch</a></li>
                <li class="menu-container-li-ct"><img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/arrow-right.png" alt=""></li>
                <li class="menu-container-li-ct"><a href="">Lịch sử nạp ATM tự động</a></li>
            </ul>
        </div>
    </section>

    <section class="media-mobile">
        <div class="container container-fix banner-mobile-container-ct">

            <div class="row marginauto banner-mobile-row-ct">
                <div class="col-auto left-right" style="width: 10%" >
                    <a href="javascript:void(0)" class="previous-step-one box-account-mobile_open" style="line-height: 28px" onclick="openMenuProfile()">
                        <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/back.png" alt="" >
                    </a>
                </div>

                <div class="col-auto left-right banner-mobile-span text-center" style="width: 80%">
                    <h1>Lịch sử nạp ATM- tự động</h1>
                </div>
                <div class="col-auto left-right" style="width: 10%">
                </div>
            </div>

        </div>
    </section>

    {{--   Bopdy --}}
    <section>
        <div class="container container-fix body-container-ct">
            <div class="row marginauto body-container-row-ct body-container-row-mobile-ct">
                @include('theme_3.frontend.widget.__navbar__profile')

                <div class="col-lg-9 col-12 body-container-detail-right-ct">
                    <div class="row marginauto logs-content">
                        <div class="col-md-12 left-right">
                            <div class="row marginauto logs-title">
                                <div class="col-md-12 left-right">
                                    <span>Lịch sử nạp ATM- tự động</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 logs-search left-right">

                            <div class="row marginauto">
                                <div class="col-12 left-right">
                                    <form class="search-txns">
                                        <div class="row marginauto body-form-search-ct">
                                            <div class="col-auto left-right">
                                                <input autocomplete="off" type="text" name="search" class="input-search-log-ct" placeholder="Nhập từ khóa">
                                                <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/search.png" alt="">
                                            </div>
                                            <div class="col-4 body-form-search-button-ct media-web">
                                                <button type="submit" class="timkiem-button-ct btn-timkiem" style="position: relative">
                                                    <span class="span-timkiem">Tìm kiếm</span>
                                                    <div class="row justify-content-center loading-data__timkiem">

                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-auto ml-auto left-right">

                                    <div class="row marginauto justify-content-end nick-findter-row">

                                        <div class="col-auto nick-findter" style="position: relative">
                                            <ul>
                                                <li class="li-boloc">Bộ lọc</li>
                                                <li class="margin-findter" style="position: relative">
                                                    <img class="lazy" src="/assets/frontend/{{theme('')->theme_key}}/image/nick/filter.png" alt="">
                                                    <span class="overlay-find" style="    position: absolute;right: -4px;top: -4px;">
                                                        0
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="row marginauto nick-findter-data">

                            </div>
                        </div>

                        {{--                        Co dữ liệu   --}}

                        <div class="col-md-12 logs-table left-right">
                            <div class="row default-table" id="data_pay_card_history_ls" style="position: relative">
                                <div class="body-box-loadding result-amount-loadding" style="position: absolute;top: 50%;left: 50%">
                                    <div class="d-flex justify-content-center">
                                        <span class="pulser"></span>
                                    </div>
                                </div>
                                @include('frontend.pages.transfer.widget.__tranfer_history')
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade login show small-log-Modal modal-logs-txns" id="openFinter" aria-modal="true">

        <div class="modal-dialog step-tab-panel modal-lg modal-dialog-centered login animated">
            <!--        <div class="image-login"></div>-->
            <div class="modal-content">
                <div class="modal-header p-0" style="border-bottom: 0">
                    <div class="row marginauto modal-header-nick-ct">
                        <div class="col-12 left-right text-center" style="position: relative">
                            <span>Bộ lọc</span>
                            <img class="lazy img-close-nick-ct close-modal-default" src="/assets/frontend/{{theme('')->theme_key}}/image/cay-thue/close.png" alt="">
                        </div>
                    </div>

                </div>

                <div class="modal-body modal-body-order-ct">
                    <form class="form-charge_ls account_content_transaction_history__v2" id="data_sort">
                    <div class="row marginauto">

{{--                            <div class="col-md-12 left-right modal-nick-padding">--}}
{{--                                <div class="row marginauto">--}}
{{--                                    <div class="col-12 left-right background-nick-col-top-ct body-title-detail-span-ct">--}}
{{--                                        <span>Ngân hàng</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 left-right background-nick-col-bottom-ct transaction-finter-nick">--}}
{{--                                        <select class="wide transaction" name="transaction">--}}
{{--                                            <option>Chọn</option>--}}
{{--                                            <option value="1">Techcombank</option>--}}
{{--                                            <option value="2">BIDV</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-12 left-right modal-nick-padding">
                                <div class="row marginauto">
                                    <div class="col-12 left-right background-nick-col-top-ct body-title-detail-span-ct">
                                        <span>Trạng thái</span>
                                    </div>
                                    <div class="col-12 left-right background-nick-col-bottom-ct status-finter-nick">
                                        <select class="wide status" name="status">
                                            <option value="">Chọn</option>
                                            <option value="1">Thành công(Đúng số tiền)</option>
                                            <option value="0">Thất bại</option>
                                            <option value="2">Chờ xử lý</option>
                                            <option value="3">Thành công(Sai số tiền)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 left-right">
                                <div class="row body-title-detail-ct">

                                    <div class="col-md-6 text-left body-title-detail-col-ct">
                                        <div class="row marginauto">
                                            <div class="col-md-12 left-right body-title-detail-span-ct">
                                                <span>Từ ngày</span>
                                            </div>
                                            <div class="col-md-12 left-right body-title-detail-select-ct">
                                                <input autocomplete="off" name="started_at" class="input-defautf-ct started_at" type="text" placeholder="Chọn">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-6 text-left body-title-detail-col-ct">
                                        <div class="row marginauto password-mobile">
                                            <div class="col-md-12 left-right body-title-detail-span-ct">
                                                <span>Đến ngày</span>
                                            </div>
                                            <div class="col-md-12 left-right body-title-detail-select-ct" style="position: relative">
                                                <input autocomplete="off" class="input-defautf-ct ended_at" name="ended_at" type="text" placeholder="Chọn">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 left-right padding-nicks-footer-ct">

                                <div class="row marginauto justify-content-center">
                                    <div class="col-md-6 col-6 modal-footer-success-col-left-ct">
                                        <div class="row marginauto modal-footer-success-row-not-ct">
                                            <div class="col-md-12 left-right">
                                                <a href="javascript:void(0)" class="button-not-bg-ct btn-reset reset-find">
                                                    <span class="span-reset">
                                                        Thiết lập lại
                                                    </span>
                                                    <div class="row justify-content-center loading-data__timkiem">

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 modal-footer-success-col-right-ct">
                                        <div class="row marginauto">
                                            <div class="col-md-12 left-right">
                                                <button class="button-default-modal-ct button-modal-nick openSuccess btn-ap-dung" type="submit">
                                                    <span class="span-ap-dung">Áp dụng</span>
                                                    <div class="row justify-content-center loading-data__timkiem">

                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="/assets/frontend/{{theme('')->theme_key}}/js/js_trong/handle-history-table.js"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/transfer/logs--update.js"></script>
@endsection







