@if(isset($data) && count($data))

    <div class="shop_product_another pt-3">
        <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold title__tklienquan">Tài khoản liên quan</h3>
            <div class="c-line-center c-theme-bg"></div>
        </div>

        <div class="shop_product_another_content">
            <div class="item_buy_list row">
                @foreach($data as $item)

                    <div class="col-6 col-sm-6 col-lg-3 fixcssacount">
                        <div class="item_buy_list_in">
                            <div class="item_buy_list_img">
                                <a href="/acc/{{ $item->randId }}">
                                    @if(isset($item->image))

                                        <img class="lazy item_buy_list_img-main" src="{{\App\Library\MediaHelpers::media($item->image)}}" alt="{{ $item->randId }}">
                                    @else
                                        <img class="item_buy_list_img-main" src="/assets/frontend/{{theme('')->theme_key}}/image/anhconten.jpg" alt="">
                                    @endif

                                    @if(isset($item->image_icon))
                                        <img class="lazy item_buy_list_img-sale" src="{{\App\Library\MediaHelpers::media($item->image_icon)}}"  alt="{{ $item->randId }}">
                                    @else
                                        <img class="item_buy_list_img-sale" src="/assets/frontend/{{theme('')->theme_key}}/image/mgg.png"  alt="">
                                    @endif
                                    <span>MS: {{ $item->randId }} </span>
                                </a>
                            </div>
                            <div class="item_buy_list_description">
                                bảo hành 100%,lỗi hoàn tiền
                            </div>
                            <div class="item_buy_list_info">
                                <div class="row">
                                    <?php
                                    $index = 0;
                                    ?>

                                    @if(isset($item->groups))
                                        <?php
                                        $att_values = $item->groups;
                                        ?>
                                        {{--                                                @dd($att_valuesv2)--}}
                                        @foreach($att_values as $att_value)

                                            @if(isset($att_value->module) && $att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                                                <?php
                                                $index++;
                                                ?>
                                                @if($index < 5)
                                                    @if(isset($att_value->parent))
                                                        <div class="row" style="margin: 0 auto;width: 100%">
                                                            <div class="col-auto item_buy_list_info_inacc fixcssacount">
                                                                {{ $att_value->parent->title??null }} :
                                                            </div>
                                                            <div class="col-auto item_buy_list_info_inaccright fixcssacount" style="color: #666;font-weight: 600;margin-left: auto">
{{--                                                                {{ $att_valuev2->title??null }}--}}
                                                                {{ isset($att_value->title) ? \Str::limit($att_value->title,16) : null }}

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif

                                    @if(isset($item->params) && isset($item->params->ext_info))
                                            <?php $params = json_decode(json_encode($item->params->ext_info),true) ?>
                                            @if(isset($item->category->childs) && count($item->category->childs)>0)
                                                @foreach($item->category->childs as $index=>$att)
                                                    @if($att->position == 'text')
                                                        @if(isset($att->childs))
                                                            @foreach($att->childs as $child)
                                                                @foreach($params as $key => $param)
                                                                    @if($key == $child->id)
                                                                        <tr>
                                                                            <td style="width:50%">{{ $child->title }}:</td>
                                                                            <td class="text-danger" style="font-weight: 700">{{ $param }}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif

                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif

                                </div>
                            </div>
                            <div class="item_buy_list_more">
                                <div class="row">
                                    <div class="col-12 fixcssacount">
                                        <div class="item_buy_list_price">
                                            <span>{{ str_replace(',','.',number_format($item->price_old)) }}đ </span>
                                            {{ str_replace(',','.',number_format($item->price)) }}đ
                                        </div>

                                    </div>
                                    <a href="/acc/{{ $item->randId }}" class="col-12 fixcssacount">
                                        <div class="item_buy_list_view">
                                            Chi tiết
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif

