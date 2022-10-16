    @if(isset($data) && count($data) > 0)

    <div class="flash-sales block-product mt-fix-20 ">
        <div class="product-header d-flex">
        <span>
                        <img src="/assets/frontend/{{theme('')->theme_key}}/image/svg/saleindex.svg" alt="">
                    </span>
            <h2 class="text-title">{{ $title??'Mua nick random' }}</h2>
            <div class="navbar-spacer"></div>

            <div class="text-view-more">
                <a href="/mua-acc" class="global__link">Xem thêm<i class="__icon --sm --link ml-1" style="--path : url(/assets/frontend/{{theme('')->theme_key}}/image/svg/arrowright.svg)"></i></a>
            </div>
        </div>
        <div class="box-product acc-swiper">
            <div class="swiper-container list-product swiper-acc" >
                <div class="swiper-wrapper">
                    @foreach($data as $key => $item)
                        @if($item->display_type == 2)
                        <div class="swiper-slide" >
                            <a href="/mua-acc/{{ isset($item->custom->slug) && $item->custom->slug != '' ? $item->custom->slug :  $item->slug }}">
                                <div class="item-product__box-img">

                                    <img onerror="imgError(this)" class="lazy" data-src="{{ isset($item->custom->image) ? \App\Library\MediaHelpers::media($item->custom->image) :  \App\Library\MediaHelpers::media($item->image) }}" alt="">

                                </div>
                                <div class="item-product__box-content">
                                    <div class="item-product__box-name text-title limit-1">{{ isset($item->custom->title) ? $item->custom->title :  $item->title }}</div>
                                    @if(isset($item->items_count))
                                        @if((isset($item->account_fake) && $item->account_fake > 1) || (isset($item->custom->account_fake) && $item->custom->account_fake > 1))
                                            <div class="item-product__box-sale">Số tài khoản: {{ str_replace(',','.',number_format(round(isset($item->custom->account_fake) ? $item->items_count*$item->custom->account_fake : $item->items_count*$item->account_fake))) }} </div>
                                        @else
                                            <div class="item-product__box-sale">Số tài khoản: {{ $item->items_count }} </div>
                                        @endif

                                    @else
                                        <div class="item-product__box-sale">Số tài khoản: 0 </div>
                                    @endif

                                    @php
                                        if (isset($item->price_old)) {
                                            $sale_percent = (($item->price_old - $item->price) / $item->price_old) * 100;
                                            $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                                        } else {
                                            $sale_percent = 0;
                                        }
                                    @endphp
                                    @if(isset($item->price))
                                    <div class="item-product__box-price">

                                        <div class="special-price">{{ str_replace(',','.',number_format($item->price)) }}đ</div>
                                        <div class="old-price">{{ str_replace(',','.',number_format($item->price_old??$item->price)) }}đ</div>
                                        @if($sale_percent > 0)
                                        <div class="item-product__sticker-percent">
                                            -{{ $sale_percent }}%
                                        </div>
                                        @endif
                                    </div>
                                    @else
                                        <div class="item-product__box-price fix_header_acount">
                                        </div>
                                    @endif
                                </div>
                            </a>

                        </div>
                        @endif
                    @endforeach

                </div>

            </div>
            <div class="swiper-button-prev">
                <img src="./assets/frontend/theme_3/image/swiper-prev.svg" alt="">
            </div>
            <div class="swiper-button-next">
                <img src="./assets/frontend/theme_3/image/swiper-next.svg" alt="">
            </div>
        </div>
    </div>
@endif
