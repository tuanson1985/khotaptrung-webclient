@extends('frontend.layouts.master')
@section('content')

    <div class="account">
        <div class="account_content">
            <div class="container">
                @include('frontend.pages.account.sidebar')
                <div class="account_sidebar_content">
                    <div class="c-layout-sidebar-content ">
                        <!-- BEGIN: PAGE CONTENT -->
                        <!-- BEGIN: CONTENT/SHOPS/SHOP-ORDER-HISTORY-2 -->
                        <div class="account_sidebar_content_title">
                            <p>Chi tiết yêu cầu #{{$data->id}} @if(isset($data->tranid)) - Mã giao dịch SMS: #{{$data->tranid}} @endif</p>
                            <div class="account_sidebar_content_line"></div>
                        </div>
                        @php
                            $input_auto = \App\Library\HelpersDecode::DecodeJson('input_auto', $data->item_ref->params);
                        @endphp

                        <div class="account_content_transaction_history">
                            <div class="row">
                                    <div class="col-md-12">
                                        @if($data->status==1)
                                            @if($input_auto==1 && ($data->item_ref->idkey!='' ||$data->item_ref->idkey!=null ))
                                            @else
                                                <button class="btn btn-danger" type="button" id="btnDestroy" title="">Hủy bỏ yêu cầu</button>
                                            @endif

                                            <div class="modal fade" id="destroyModal" role="dialog" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        {{Form::open(array('url'=>'/dich-vu/log/detail/destroy/'.$data->id,'class'=>'m-form','method'=>'post'))}}
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;text-align: center">Chỉnh sửa thông tin</h4>

                                                        </div>
                                                        <div class="modal-body">
                                                            <span class="mb-15 control-label bb">Lỗi thuộc về:</span>
                                                            <div class="mb-15">
                                                                {{Form::select('mistake_by',array(''=>'-- Không chọn --')+config('module.service.mistake_by'),Request::get('mistake_by'),array('required'=>'','class'=>"form-control"))}}
                                                            </div>
                                                            <span class="mb-15 control-label bb">Nội dung:</span>
                                                            <textarea style="min-height:100px;" type="text" class="form-control" name="note" placeholder="Nội dung ít nhất 10 ký tự"></textarea>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" style="">Xác nhận</button>
                                                            <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
                                                        </div>
                                                        {{Form::close()}}

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                        </div>

                        <div class="padding-left" style="font-family: Roboto, sans-serif;">
                            <div class="cand-details" id="about" style="float: left;width: 100%">
                                <h2>Tên dịch vụ</h2>
                                <p><a class="thea_dichvu" href="/dich-vu/{{(isset($data->item_ref->slug)?$data->item_ref->slug:"Lỗi")}}">{{$data->title}}</a></p>

                                <h2>Công việc</h2>
                                <div class="edu-history-sec" id="education">
                                    @if(!empty($data->workname) && count($data->workname)>0)
                                        @foreach( $data->workname as $index=> $aWorkName)
                                            <div class="edu-history">
                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                <div class="edu-hisinfo">
                                                    <h3>{{$aWorkName->title}}</h3>
                                                    <i>{{number_format($aWorkName->unit_price)}} VNĐ</i>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif


                                </div>
                                <h2>Thông tin đính kèm</h2>
                                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded">
                                    <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand">
                                        <thead class="m-datatable__head">
                                        <tr class="m-datatable__row">
                                            <th style="width:50px;" class="m-datatable__cell">
                                                #
                                            </th>
                                            <th class="m-datatable__cell">
                                                Tên thông tin
                                            </th>
                                            <th style="width:150px;" class="m-datatable__cell">
                                                Nội dung
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="m-datatable__body">
                                        @php
                                            $send_name=\App\Library\HelpersDecode::DecodeJson('send_name',$data->item_ref->params);
                                            $send_type=\App\Library\HelpersDecode::DecodeJson('send_type',$data->item_ref->params);
                                            $server_data=\App\Library\HelpersDecode::DecodeJson('server_data',$data->item_ref->params);
                                        @endphp
                                        @if(\App\Library\HelpersDecode::DecodeJson('server_mode',$data->item_ref->params)==1)
                                            <tr>
                                                <td>1</td>
                                                <td> Server</td>
                                                <td>
                                                    {{isset($server_data[$data->position])?$server_data[$data->position]:""}}
                                                </td>
                                            </tr>
                                        @endif
                                        @if(!empty($send_name)&& count($send_name)>0)


                                            @foreach( $send_name as $index=> $aSendName)

                                                <tr>
                                                    @if(\App\Library\HelpersDecode::DecodeJson('server_mode',$data->item_ref->params)==1)
                                                        <td> {{$index+1+1}} </td>
                                                    @else
                                                        <td> {{$index+1}} </td>
                                                    @endif

                                                    <td> {{$aSendName}} </td>
                                                    <td>
                                                        @if($send_type[$index]==4)
                                                            <a href="{{\App\Library\HelpersDecode::DecodeJson('customer_data'.$index,$data->params)}}" target="_blank">
{{--                                                                <img src="{{\App\Library\Files::media(\App\Library\Helpers::DecodeJson('customer_data'.$index,$data->params))}}" alt="" style="max-width: 100px;max-height: 100px;">--}}
                                                            </a>
                                                        @else
                                                            {{\App\Library\HelpersDecode::DecodeJson('customer_data'.$index,$data->params)}}
                                                        @endif
                                                    </td>


                                                </tr>

                                            @endforeach
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                                <div class="m-separator m-separator--dashed"></div>

                                <div style="text-align: right">

                                    @if($data->status==1)

                                        @if($input_auto==1 && ($data->item_ref->idkey!='' ||$data->item_ref->idkey!=null ))
                                        @else
                                            <button class="btn btn-brand btn-edit" id="btn-edit">Chỉnh sửa thông tin</button>
                                        @endif

                                        <div class="modal fade" id="edit_info" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    {{Form::open(array('url'=>'/dich-vu/log/detail/edit-info/'.$data->id,'class'=>'m-form','method'=>'post'))}}
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;text-align: center">Chỉnh sửa thông tin</h4>

                                                    </div>
                                                    <div class="modal-body">

                                                        @php
                                                            $send_name=\App\Library\HelpersDecode::DecodeJson('send_name',$data->item_ref->params);
                                                            $send_type=\App\Library\HelpersDecode::DecodeJson('send_type',$data->item_ref->params);
                                                        @endphp
                                                        @if(!empty($send_name)&& count($send_name)>0)
                                                            @for ($i = 0; $i < count($send_name); $i++)
                                                                @if($send_name[$i]!=null)
                                                                    <span class="mb-15 control-label bb">{{$send_name[$i]}}:</span>
                                                                    check trường của sendname
                                                                    @if($send_type[$i]==1 || $send_type[$i]==2||$send_type[$i]==3)
                                                                        <div class="mb-15">
                                                                            <input type="text" required name="customer_data{{$i}}" value="{{\App\Library\HelpersDecode::DecodeJson('customer_data'.$i,$data->params)}}" class="form-control t14 " placeholder="{{$send_name[$i]}}" value="">
                                                                        </div>

                                                                    @elseif($send_type[$i]==4)
                                                                        <div class="mb-15">
                                                                            <input type="file" required accept="image/*" class="form-control" name="customer_data{{$i}}" value="{{\App\Library\HelpersDecode::DecodeJson('customer_data'.$i,$data->params)}}" placeholder="{{$send_name[$i]}}">
                                                                        </div>
                                                                    @elseif($send_type[$i]==5)
                                                                        <div class="mb-15">
                                                                            <input type="password" required class="form-control" name="customer_data{{$i}}" value="{{\App\Library\HelpersDecode::DecodeJson('customer_data'.$i,$data->params)}}" placeholder="{{$send_name[$i]}}">
                                                                        </div>
                                                                    @elseif($send_type[$i]==6)
                                                                        @php
                                                                            $send_data=\App\Library\HelpersDecode::DecodeJson('send_data'.$i,$data->params);
                                                                        @endphp
                                                                        <div class="mb-15">
                                                                            <select name="customer_data{{$i}}" required class="mb-15 control-label bb">
                                                                                @if(!empty($send_data))
                                                                                    @for ($sn = 0; $sn < count($send_data); $sn++)
                                                                                        <option value="{{$sn}}" {{\App\Library\HelpersDecode::DecodeJson('customer_data'.$i,$data->params)==$sn?"selected":""}}>{{$send_data[$sn]}}</option>
                                                                                    @endfor
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    @endif

                                                                @endif
                                                            @endfor
                                                        @endif

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" id="d3" style="">Cập nhật</button>
                                                        <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                    {{Form::close()}}

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <h2>Tiến độ</h2>
                                <div class="edu-history-sec" id="experience">

                                    @if(!empty($data->workflow) && count($data->workflow)>0)
                                        @foreach( $data->workflow as $index=> $aWorkFlow)
                                            <div class="edu-history style2">
                                                <i></i>
                                                <div class="edu-hisinfo">
                                                    <h3>
                                                        @if($aWorkFlow->status==0)
                                                            {{config('module.service.purchase_status.0')}}
                                                        @elseif($aWorkFlow->status==1)
                                                            {{config('module.service.purchase_status.1')}}
                                                        @elseif($aWorkFlow->status==2)
                                                            {{config('module.service.purchase_status.2')}}
                                                        @elseif($aWorkFlow->status==3)
                                                            {{config('module.service.purchase_status.3')}}
                                                        @elseif($aWorkFlow->status==4)
                                                            {{config('module.service.purchase_status.4')}}
                                                        @elseif($aWorkFlow->status==5)
                                                            {{config('module.service.purchase_status.5')}}
                                                        @endif
                                                        @if($aWorkFlow->content!="")
                                                            -:- {{$aWorkFlow->content}}
                                                        @endif
                                                    </h3>
                                                    <i>{{ formatDateTime($aWorkFlow->created_at) }}</i>
                                                </div>
                                            </div>

                                        @endforeach
                                    @endif
                                </div>
                                <div style="text-align: right">
                                </div>
                                <h2>Trao đổi  <a href="/inbox/{{$data->id}}/send" class="btn btn-brand btn-edit" id="btn-edit">Nhắn tin</a></h2>
                                <div class="edu-history-sec" id="awards">
                                    <span>Chưa có nội dung</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cand-details {
            margin-bottom: 15px;
        }
        .cand-details h2 {
            float: left;
            width: 100%;
            font-size: 24px;
            font-weight: 600;
            color: #505050;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .thea_dichvu{
            color: #8b91dd;
            font-size: 16px;
        }
        .thea_dichvu:hover{
            text-decoration: none;
            opacity: 0.7;
        }
        .edu-history-sec {
            float: left;
            width: 100%;
            padding-left: 30px;
        }
        .edu-history {
            float: left;
            width: 100%;
            display: table;
            margin-bottom: 20px;
            position: relative;
        }
        .edu-history > i {
            display: table-cell;
            vertical-align: top;
            width: 70px;
            font-size: 50px;
            color: #fb236a;
            line-height: 60px;
        }
        .edu-hisinfo {
            display: table-cell;
            vertical-align: top;
        }
        .edu-hisinfo > h3 {
            font-size: 20px;
            color: #8b91dd;
            margin: 4px 0;
        }
        .edu-hisinfo > i {
            font-size: 18px;
            color: #888888;
        }
        .m-table.m-table--head-bg-brand thead th {
            background: #716aca;
            color: #ffffff;
            border-bottom: 0;
            border-top: 0;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857;
            vertical-align: top;
            border-top: 1px solid #e7ecf1;
        }
        .edu-history.style2 {
            margin: 0;
            padding-bottom: 20px;
            position: relative;
            padding-left: 40px;
            margin-bottom: 24px;
        }
        .edu-history {
            float: left;
            width: 100%;
            display: table;
            margin-bottom: 20px;
            position: relative;
        }
        .edu-history.style2::before {
            position: absolute;
            left: 7px;
            top: 20px;
            width: 2px;
            height: 100%;
            content: "";
            background: #e8ecec;
        }
        .edu-history.style2 > i {
            position: absolute;
            left: 0;
            top: 0;
            width: 16px;
            height: 16px;
            border: 2px solid #8b91dd;
            content: "";
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
        }
        .edu-history > i {
            display: table-cell;
            vertical-align: top;
            width: 70px;
            font-size: 50px;
            color: #fb236a;
            line-height: 60px;
        }
        .edu-hisinfo > h3 {
            color: #8b91dd;
            margin: 4px 0;
        }
        .edu-hisinfo > i {
            font-size: 18px;
            color: #888888;
        }
        .btn-edit {
            float: right;
            background: #32c5d2;
            border: 2px solid #32c5d2;
            color: #ffffff;
            font-family: Roboto, sans-serif;
            font-size: 14px;
            padding: 11px 17px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            -ms-border-radius: 8px;
            -o-border-radius: 8px;
            border-radius: 8px;
            -webkit-transition: all 0.2s ease 0s;
            -moz-transition: all 0.2s ease 0s;
            -ms-transition: all 0.2s ease 0s;
            -o-transition: all 0.2s ease 0s;
            transition: all 0.2s ease 0s;
            outline: 0 none;
        }
        .btn-edit:hover {
            background-color: #ffffff;
            color: #32c5d2;
        }
    </style>

    <script src="/assets/frontend/{{theme('')->theme_key}}/js/service/service-history.js"></script>
@endsection


