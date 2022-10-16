@if (isset($datacate) && count($datacate) > 0)

    <div class="container item_play_dif__img">
        <div class="row">
            <div class="col-md-12">
                <div class="h3" style="font-size: 24px;font-weight: 700;color: white">DỊCH VỤ KHÁC</div>
                <div class="news_content_line"></div>
            </div>
            @if(isset($datacate) && count($datacate) > 0)
                @foreach ($datacate as $item)
                    <div class="col-6 col-sm-6 col-lg-3 fixcssacount fixslidercsssev">
                        <div class="item_buy_list_in">
                            <div class="item_buy_list_img">
                                <a href="/dich-vu/{{ $item->slug }}">
                                    <img class="item_buy_list_img-main lazy" src="{{\App\Library\MediaHelpers::media($item->image)}}" alt="">
                                </a>
                            </div>

                            <div class="item_buy_list_info">
                                <div class="row">
                                    <div class="col-12 item_buy_list_info_in">
                                <span style="font-weight: bold;color: #f7b03c;font-size: 16px;">
                                    {{ $item->title }}
                                </span>
                                    </div>

{{--                                    <div class="col-12 item_buy_list_info_in">--}}
{{--                                        <span></span>--}}
{{--                                    </div>--}}

                                    <div class="col-12 item_buy_list_info_in">
                                        @if(isset($item->total_order))
                                            @if($item->params_plus)
                                                @foreach($item->params_plus as $key => $val)
                                                    @if($key == 'fk_buy')
                                                        <span>Giao dịch: {{ str_replace(',','.',number_format($item->total_order + $val)) }}</span>
                                                    @endif
                                                @endforeach

                                            @else
                                                <span>Giao dịch: {{ str_replace(',','.',number_format($item->total_order)) }}</span>
                                            @endif

                                        @else
                                            @if($item->params_plus)
                                                @foreach($item->params_plus as $key => $val)
                                                    @if($key == 'fk_buy')
                                                        <span>Giao dịch: {{ str_replace(',','.',number_format($val)) }}</span>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span>Giao dịch: 0</span>
                                            @endif

                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="item_buy_list_more">
                                <div class="row">

                                    <a href="/dich-vu/{{ $item->slug }}" class="col-12">
                                        <div class="item_buy_list_view">
                                            CHI TIẾT
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-left">
                    <span style="font-size: 16px;color: red">Dữ liệu cần tìm không tồn tại vui lòng thử lại.</span>
                </div>
            @endif
        </div>
    </div>

@endif
