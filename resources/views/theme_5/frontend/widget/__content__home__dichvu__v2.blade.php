@if(isset($data))

    <section class="acc-game-v2 c-pt-12 c-pt-lg-6">
        <div class="section-header c-mb-24 c-mb-lg-20 justify-content-between">
            <h2 class="section-title fz-lg-20 lh-lg-24">
                <i class="icon-title c-mr-8" style="--path:url(/assets/frontend/{{theme('')->theme_key}}/image/svg/acc-game.svg)"></i>
                {{--                {{ $title??'Dịch vụ' }}--}}
                {{ config('module.type.2')??'Dịch vụ game' }}
            </h2>
            <a href="/dich-vu" class="link arr-right">Xem tất cả</a>
        </div>
        <div class="list-category">
            @foreach($data as $item)
                <div class="item-category c-px-8 c-mb-12 c-px-lg-6">
                    <div class="card">
                        <div class="card-body c-p-16 c-p-lg-12 scale-thumb">
                            <a href="/dich-vu/{{ $item->slug}}">
                                <div class="card-thumb c-mb-8">
                                    <img onerror="imgError(this)" src="{{\App\Library\MediaHelpers::media($item->image)}}" alt="" class="card-thumb-image">
                                </div>
                                <div class="card-attr">
                                    <div class="text-title text-limit limit-1 fw-700">
                                        {{ $item->title  }}
                                    </div>
                                    <div class="info-attr">
                                        Giao dịch: 0
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endif
