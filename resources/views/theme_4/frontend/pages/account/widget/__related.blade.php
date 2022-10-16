@if(isset($data) && count($data))

    @foreach($data as $item)
        @if($item->status == 1)
        <div class="col-md-3 col-sm-6 col-6 entries_item" style="display: block">
            <a href="/acc/{{ $item->randId }}">
                <img src="{{\App\Library\MediaHelpers::media($item->image)}}"
                     alt="{{ $item->title }}" class="entries_item-img">
                <h2 class="text-title text-left  fw-bold" style="color: #434657;margin-bottom: 8px">#{{ $item->randId }}</h2>
                <?php
                $total = 0;
                ?>
                @if(isset($item->groups))
                    <?php
                    $att_values = $item->groups;
                    ?>
                    @foreach($att_values as $att_value)
                        {{--            @dd($att_value)--}}
                        @if($att_value->module == 'acc_label' && $att_value->is_slug_override == null)
                            {{--                                                        @dd($att_value->parent)--}}
                            @if(isset($att_value->parent))
                                @if($total < 4)
                                    <?php
                                    $total = $total + 1;
                                    ?>
                                    <p class="text-left" style="color: #82869E;margin-bottom: 4px">{{ $att_value->parent->title??null }}: {{ isset($att_value->title)? \Str::limit($att_value->title,16) : null }}</p>
                                @endif
                            @endif
                        @endif
                    @endforeach
                @endif

{{--                @if(isset($item->params) && isset($item->params->ext_info))--}}
{{--                    <?php--}}
{{--                    $params = json_decode(json_encode($item->params->ext_info),true);--}}
{{--                    ?>--}}

{{--                    @if($total < 4)--}}
{{--                        @if(!is_null($dataAttribute) && count($dataAttribute)>0)--}}
{{--                            @foreach($dataAttribute as $index=>$att)--}}
{{--                                @if($att->position == 'text')--}}
{{--                                    @if(isset($att->childs))--}}
{{--                                        @foreach($att->childs as $child)--}}
{{--                                            @foreach($params as $key => $param)--}}
{{--                                                @if($key == $child->id && $child->is_slug_override == null)--}}

{{--                                                    @if($total < 4)--}}
{{--                                                        <?php--}}
{{--                                                        $total = $total + 1;--}}
{{--                                                        ?>--}}
{{--                                                        <p class="text-left" style="color: #82869E;margin-bottom: 4px">{{ $child->title??null }}: {{ isset($param) ? \Str::limit($param,16) : null }}</p>--}}
{{--                                                    @endif--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    @endif--}}
{{--                @endif--}}
                @php
                    if (isset($item->price_old)) {
                        $sale_percent = (($item->price_old - $item->price) / $item->price_old) * 100;
                        $sale_percent = round($sale_percent, 0, PHP_ROUND_HALF_UP);
                    } else {
                        $sale_percent = 0;
                    }
                @endphp
                <h2 class="text-left" style="color: rgb(238, 70, 35);font-size: 16px;margin-bottom: 0;margin-top: 8px">{{ str_replace(',','.',number_format($item->price)) }}đ</h2>
                <p class="text-left" style="color: #82869E;margin-bottom: 0;font-size: 14px;text-decoration: line-through;">{{ str_replace(',','.',number_format($item->price_old)) }}đ <span class="badge badge-success" style="margin-left: 4px;padding-top: 4px;background: rgb(238, 70, 35);">{{ $sale_percent }}%</span></p>
            </a>
        </div>
        @endif
    @endforeach

@endif


