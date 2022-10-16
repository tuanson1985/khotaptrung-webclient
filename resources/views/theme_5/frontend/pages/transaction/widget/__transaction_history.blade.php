@php
    $result = array();
    foreach ($data as $element) {
        $result[date('m/y',strtotime($element->created_at))][] = $element;
    }
    $prev = null;
@endphp
@forelse($result as $key => $group)
    @if(date('m-y',strtotime($key)) != $prev)
        <div class="text-title-bold fw-500 c-mb-12">Tháng {{date('m',strtotime($key))}}</div>
        @php
            $prev = date('m-y',strtotime($key));
        @endphp
    @endif

    <ul class="trans-list">
        @forelse($group as $item)
            <li class="trans-item">
                <a href="/lich-su-giao-dich-{{ $item->id }}">
                    <div class="text-left">
                    <span class="t-body-2 title-color c-mb-0 text-limit limit-1 bread-word">
{{--                       {{ @$item->description }}--}}
                        @foreach($config as $ils => $valls)
                            @if($ils == $item->trade_type)
                                {{ $valls }} (#{{ $item->id }})
                            @endif
                        @endforeach
                    </span>
                        <span class="t-body-1 link-color">
                        {{date('d/m/Y - H:i', strtotime($item->created_at))}}
                    </span>
                    </div>
                    <div class="text-right">
                        <span class="fw-500 d-block c-mb-0">{{ number_format($item->amount, 0, ',', '.') }}đ</span>
                        @switch($item->status)
                            @case(1)
                            <span class="success-color c-mb-0">Thành công</span>
                            @break
                            @case(0)
                            <span class="invalid-color c-mb-0">Thất bại</span>
                            @break
                            @case(2)
                            <span class="warning-color c-mb-0">Đang xử lý</span>
                            @break
                        @endswitch
                    </div>
                </a>
            </li>
        @empty
        @endforelse
    </ul>
@empty
@endforelse
