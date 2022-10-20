@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head')
@endsection
@section('meta_robots')
    <meta name="robots" content="index,follow" />
@endsection

@section('content')
    <div class="container c-container" id="account-list">
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

        <ul class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="/" class="breadcrumb-link">Trang chủ</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/mua-acc" class="breadcrumb-link">Shop Account</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/mua-acc/{{ isset($data->custom->title) ? $data->custom->title :  $data->title }}" class="breadcrumb-link">Danh sách Nick Liên Quân</a>
            </li>
        </ul>
        <div class="head-mobile">
            <a href="/mua-acc" class="link-back"></a>

            <h1 class="head-title text-title">Shop Account</h1>

            <a href="/" class="home"></a>
        </div>

        {{--            Slider baner    --}}
        @include('frontend.widget.__slider__banner__account')
            <div class="booking_detail"></div>
{{--        Danh sách acount    --}}

            <section class="list-account">
                <div class="section-header justify-content-between  d-none d-lg-flex c-py-16">
                    <h2 class="section-title">{{ isset($data->custom->title) ? $data->custom->title :  $data->title }} </h2>
                    <form action="" class="form-search position-relative">
                        <input type="search" placeholder="Tìm kiếm" class="has-submit">
                        <button type="submit"></button>
                    </form>
                </div>
                <div class="filter-account c-my-16 d-none d-lg-flex">
                    <div class="filter-title text-title fw-700">
                        Chọn game muốn mua account
                    </div>
                    <div class="value-filter">
                        <div class="nick-findter-data" id="params-filter">

                        </div>
                        <div class="show-modal-filter noselect" data-toggle="modal" data-target="#modal-filter">Bộ lọc</div>
                    </div>
                </div>
                <div class="sort-account c-mb-16 d-none d-lg-flex">
                    <div class="text-title fw-700" id="numberResult"></div>
                    <div class="value-sort d-flex align-items-center">
                        <div class="text-title fw-700 c-mr-16">
                            Sắp xếp theo:
                        </div>
                        <div>
                            <a href="#" class="selection active md" data-sort="random">Ngẫu nhiên</a>
                            <a href="#" class="selection md" data-sort="price_start">Giá từ cao đến thấp</a>
                            <a href="#" class="selection md" data-sort="price_end">Giá từ thấp đến cao</a>
                            <a href="#" class="selection md" data-sort="created_at_start">Mới nhất</a>
                            <a href="#" class="selection md" data-sort="created_at_end">Cũ nhất</a>
                        </div>
                    </div>
                </div>

                <!-- Mobile -->
                <form action="" class="form-search c-mb-24 d-lg-none">
                    <input type="search" placeholder="Tìm kiếm" class="search">
                </form>
                <div class="text-title fw-700 c-mb-8 d-lg-none">Nick Freefire cực phẩm</div>
                <div class="mobile-tools c-mb-8 d-lg-none">
                    <label class="tool-filter c-mr-12 open-sheet" data-target="#sheet-filter">
                        Bộ lọc
                    </label>
                    <label class="tool-sort open-sheet" data-target="#sheet-sort">
                        Giá thấp nhất
                    </label>
                </div>
                <!-- End Mobile -->

                <div class="is-load">
                    <div class="loading-wrap">
                        <span class="modal-loader-spin"></span>
                    </div>
                    <div class="listing-account list-content">

                        {{--                        @include('frontend.pages.account.widget.__datalist')--}}

                    </div>
                </div >

            </section>
            <!-- Modal Filter -->
            <div class="modal fade" id="modal-filter">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="" class="form-filter">

                            <div class="modal-header">
                                <h2 class="modal-title center">Bộ lọc</h2>
                                <button type="button" class="close" data-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="input-group">
                                    <label class="form-label">
                                        Mã số
                                    </label>
                                    <input type="text" class="input-defautf-ct id" name="id_data" placeholder="Nhập mã số nick">
                                </div>

                                <div class="input-group">
                                    <label class="form-label">
                                        Giá tiền
                                    </label>
                                    <select name="price_data" class="price" id="">
                                        <option value="" selected>Chọn giá tiền</option>
                                        <option value="0-50000">Dưới 50K</option>
                                        <option value="50000-200000">Từ 50K - 200K</option>
                                        <option value="200000-500000">Từ 200K - 500K</option>
                                        <option value="500000-1000000">Từ 500K - 1 Triệu</option>
                                        <option value="1000000-5000000">Trên 1 Triệu</option>
                                        <option value="5000000-10000000">Trên 5 Triệu</option>
                                        <option value="10000000">Trên 10 Triệu</option>
                                    </select>
                                </div>

                                <div class="input-group">
                                    <label class="form-label">
                                        Trạng thái
                                    </label>
                                    <select name="status_data" class="" id="">
                                        <option value="" selected>Chọn trạng thái</option>
                                        <option value="1">Chưa bán</option>
                                        <option value="2">Đã bán</option>
                                    </select>
                                </div>
                                @if(isset($auto_properties))
                                    @foreach($auto_properties as $auto_propertie)
                                        @if($auto_propertie->key == 'champions')
                                            <div class="input-group">
                                                <label class="form-label">
                                                    {{ $auto_propertie->name }}
                                                </label>
                                                <select name="champions_data" class="select-2-custom w-100" id="">
                                                    <option value="">--Không chọn--</option>
                                                    @if(isset($auto_propertie->childs))
                                                        @foreach($auto_propertie->childs as $child)
                                                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="input-group">
                                                <label class="form-label">
                                                    Trang phục
                                                </label>
                                                <select name="skill_data" class="select-2-custom w-100" id="">
                                                    <option value="">--Không chọn--</option>
                                                    @if(isset($auto_propertie->childs) && count($auto_propertie->childs))
                                                        @foreach($auto_propertie->childs as $child)

                                                            @if(isset($child->childs) && count($child->childs))
                                                                @foreach($child->childs as $c_child)
                                                                    <option value="{{ $c_child->id }}">{{ $c_child->name }}</option>
                                                                @endforeach
                                                            @endif

                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        @elseif($auto_propertie->key == 'tftcompanions')
                                            <div class="input-group">
                                                <label class="form-label">
                                                    {{ $auto_propertie->name }}
                                                </label>
                                                <select name="tftcompanions_data" class="select-2-custom w-100" id="">
                                                    <option value="">--Không chọn--</option>
                                                    @if($auto_propertie->childs)
                                                        @foreach($auto_propertie->childs as $child)
                                                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        @elseif($auto_propertie->key == 'tftmapskins')
                                            <div class="input-group">
                                                <label class="form-label">
                                                    {{ $auto_propertie->name }}
                                                </label>
                                                <select name="tftmapskins_data" class="select-2-custom w-100" id="">
                                                    <option value="">--Không chọn--</option>
                                                    @if($auto_propertie->childs)
                                                        @foreach($auto_propertie->childs as $child)
                                                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        @elseif($auto_propertie->key == 'tftdamageskins')
                                            <div class="input-group">
                                                <label class="form-label">
                                                    {{ $auto_propertie->name }}
                                                </label>
                                                <select name="tftdamageskins_data" class="select-2-custom w-100" id="">
                                                    <option value="">--Không chọn--</option>
                                                    @if($auto_propertie->childs)
                                                        @foreach($auto_propertie->childs as $child)
                                                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                        @endif
                                    @endforeach
                                @else
                                @if(isset($dataAttribute) && count($dataAttribute) > 0)
                                    @foreach($dataAttribute as $val)
                                        @if($val->position == 'select')
                                            <div class="input-group">
                                                <label class="form-label">
                                                    {{ $val->title }}
                                                </label>
                                                <select class="account-filter-field" name="select_data"  data-title="{{ $val->title }}">
                                                    <option value="" selected>--Không chọn--</option>
                                                    @foreach($val->childs as $child)
                                                        <option value="{{ $child->id }}">{{ $child->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @endif
{{--                                <div class="input-group">--}}
{{--                                    <label class="form-label">--}}
{{--                                        Giá tiền--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="c-pt-36">--}}
{{--                                    <div class="slider-input" data-min="20" data-max="50" data-option="10,100" data-start="50,60"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="modal-footer c-mt-24 c-mt-lg-16">
                                <a href="javascript:void(0)" class="btn ghost js-reset-form">Xoá bộ lọc</a>
                                <button type="button" class="btn primary js-submit-form">Xem kết quả</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sheet filter -->
            <div class="bottom-sheet" id="sheet-filter" aria-hidden="true" data-height="60">
                <div class="layer"></div>
                <div class="content-bottom-sheet bar-slide">
                    <form action="" class="form-filter">
                        <div class="sheet-header">
                            <h2 class="text-title center">
                                Bộ lọc
                            </h2>
                            <label class="close"></label>
                        </div>
                        <div class="sheet-body">
                            <!-- body -->
                            <div class="input-group">
                                <span class="form-label">
                                    Mã số
                                </span>
                                <input type="text" class="id"  name="id_data" placeholder="Nhập mã số nick">
                            </div>

                            <div class="input-group">
                                <span class="form-label">
                                    Trạng thái
                                </span>
                                <select name="status" class="status">
                                    <option value="" selected disabled>Chọn trạng thái</option>
                                    <option value="">Chưa bán</option>
                                    <option value="">Đã bán</option>
                                </select>
                            </div>

                            <div class="input-group">
                                <label class="form-label">
                                    Giá tiền
                                </label>
                                <select name="price_data" class="price" id="">
                                    <option value="" selected disabled>Chọn giá tiền</option>
                                    <option value="0-50000">Dưới 50K</option>
                                    <option value="50000-200000">Từ 50K - 200K</option>
                                    <option value="200000-500000">Từ 200K - 500K</option>
                                    <option value="500000-1000000">Từ 500K - 1 Triệu</option>
                                    <option value="1000000-5000000">Trên 1 Triệu</option>
                                    <option value="5000000-10000000">Trên 5 Triệu</option>
                                    <option value="10000000">Trên 10 Triệu</option>
                                </select>
                            </div>

                            @if(isset($dataAttribute) && count($dataAttribute) > 0)
                                @foreach($dataAttribute as $val)
                                    @if($val->position == 'select')
                                        <div class="input-group">
                                            <label class="form-label">
                                                {{ $val->title }}
                                            </label>
                                            <select class="account-filter-field" name="attribute_id_{{ $val->id }}"  data-title="{{ $val->title }}" id="">
                                                <option value="" selected disabled>--Không chọn--</option>
                                                @foreach($val->childs as $child)
                                                    <option value="{{ $child->id }}">{{ $child->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="sheet-footer">
                            <button type="button" class="btn ghost js-reset-form">Xoá bộ lọc</button>
                            <button type="button" class="btn primary js-submit-form">Xem kết quả</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Bottom sheet sort -->
            <div class="bottom-sheet" id="sheet-sort" aria-hidden="true" data-height="25">
                <div class="layer"></div>
                <div class="content-bottom-sheet bar-slide">
                    <form action="" id="form-sort">
                        <div class="sheet-header">
                            <h2 class="text-title center">
                                Sắp xếp theo
                            </h2>
                            <label class="close"></label>
                        </div>
                        <div class="sheet-body">
                            <!-- body -->
                            <div class="c-mb-8">
                                <label for="lowest_price" class="input-radio">
                                    <input type="radio" name="sort" id="lowest_price" checked>
                                    <span class="checkmark"></span>
                                    <span class="text-label">Giá thấp nhất</span>
                                </label>
                            </div>
                            <div class="c-mb-8">
                                <label for="highest_price" class="input-radio">
                                    <input type="radio" name="sort" id="highest_price">
                                    <span class="checkmark"></span>
                                    <span class="text-label">Giá cao nhất</span>
                                </label>
                            </div>
                            <div class="c-mb-8">
                                <label for="selling_well" class="input-radio">
                                    <input type="radio" name="sort" id="selling_well">
                                    <span class="checkmark"></span>
                                    <span class="text-label">Đang bán chạy</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
{{--  Danh mục nick khác   --}}
        @include('frontend.pages.account.widget.__related__category')

        {{--            Dịch vụ khác   --}}
        @include('frontend.widget.__services__other')

            <input type="hidden" value="{{ $slug }}" name="slug" class="slug">
            {{--    <input type="hidden" value="{{ $slug_category }}" name="slug_category" class="slug_category">--}}
            <input type="hidden" name="id_data" class="id_data" value="">
            <input type="hidden" name="title_data" class="title_data" value="">
            <input type="hidden" name="price_data" class="price_data" value="">
            <input type="hidden" name="select_data" class="select_data" value="">
            <input type="hidden" name="status_data" class="status_data" value="">
            <input type="hidden" name="sort_by_data" class="sort_by_data" value="">

            {{--    Modal xác nhận thanh toán--}}
            <div class="modal fade modal-big modal__buyacount loadModal__acount" id="LoadModal">
                <div class="modal-dialog modal-dialog-centered modal-custom">
                    <div class="modal-content c-p-24 data__form__random">

                    </div>
                </div>
            </div>

            <!-- Modal 04 -->
            <div class="modal fade modal-small" id="notBuy">
                <div class="modal-dialog modal-dialog-centered modal-custom">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center p-0">
                            <img class="c-pt-16 c-pb-16" src="/assets/frontend/{{theme('')->theme_key}}/image/son/thatbai.png" alt="">
                        </div>
                        <div class="modal-body text-center c-pl-24 c-pr-24 pt-0 pb-0">
                            <p class="fw-700 fz-15 c-mt-12 mb-0 text-title-theme">Mua thẻ nick thất bại</p>
                            <p class="fw-400 fz-13 c-mt-10 mb-0">Rất tiếc việc mua nick đã thất bại do tài khoản của bạn không đủ, vui lòng nạp tiền để tiếp tục giao dịch!</p>
                        </div>
                        <div class="modal-footer c-p-24">
                            <button class="btn primary handle-recharge-modal" data-tab="1" data-dismiss="modal">Nạp tiền</button>
                        </div>
                    </div>
                </div>
            </div>



        @endif
    </div>


@endsection

@section('scripts')
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/nick/buyaccrandom.js?v={{time()}}"></script>
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/nick/account-list.js?v={{time()}}"></script>

    <script>
        // config select 2

        let $select_2 = $('.select-2-custom');
        $select_2.select2({
            placeholder: '--Không chọn--',
            allowClear: true,
        });
    </script>
@endsection

