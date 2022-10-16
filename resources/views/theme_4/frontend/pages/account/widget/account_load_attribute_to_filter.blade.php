<div class="col-md-3" style="padding-top: 8px;padding-right: 8px;padding-left: 8px;padding-bottom: 8px">
    <div class="input-group m-b-10 c-square">
        <div class="input-group date date-picker">
            <span class="input-group-btn">
            <p class="input-group-btn-p">Mã số</p>
            </span>
            <input type="text" class="form-control c-square c-theme id" name="id" placeholder="Mã số" autocomplete="off" value="">
        </div>
    </div>
</div>


<div class="col-md-3" style="padding-top: 8px;padding-right: 8px;padding-left: 8px;padding-bottom: 8px">
    <div class="input-group m-b-10 c-square">
        <div class="input-group date date-picker">
            <span class="input-group-btn">
            <p class="input-group-btn-p">Giá tiền</p>
            </span>
            <select type="text" name="price" class="form-control c-square c-theme price" style="height: 40px">
                <option value="">Chọn giá tiền</option>
                <option value="0-50000">Dưới 50K</option>
                <option value="50000-200000">Từ 50K - 200K</option>
                <option value="200000-500000">Từ 200K - 500K</option>
                <option value="500000-1000000">Từ 500K - 1 Triệu</option>
                <option value="1000000-5000000">Trên 1 Triệu</option>
                <option value="5000000-10000000">Trên 5 Triệu</option>
                <option value="10000000">Trên 10 Triệu</option>
            </select>
        </div>
    </div>

</div>

<div class="col-md-3" style="padding-top: 8px;padding-right: 8px;padding-left: 8px;padding-bottom: 8px">
    <div class="input-group date date-picker">
        <span class="input-group-btn">
        <p class="input-group-btn-p">Trạng thái</p>
        </span>
        <select class="form-control c-square c-theme status" name="status" style="height: 40px">
            <option value="">Chọn trạng thái</option>
            <option value="1">Chưa bán</option>
            <option value="0">Đã bán</option>
        </select>
    </div>

</div>

@if(isset($dataAttribute) && count($dataAttribute) > 0)
    @foreach($dataAttribute as $val)
        {{--        @dd($val)--}}
        @if($val->position == 'select')
            <div class="col-md-3" style="padding-top: 8px;padding-right: 8px;padding-left: 8px;padding-bottom: 8px">
                <div class="input-group date date-picker">
                    <span class="input-group-btn">
                    <p class="input-group-btn-p">{{ $val->title }}</p>
                    </span>
                    <select class="form-control c-square c-theme select" name="attribute_id_{{ $val->id }}" style="height: 40px">
                        <option value="">--Không chọn--</option>
                        @foreach($val->childs as $child)
                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

        @endif
    @endforeach
@endif



