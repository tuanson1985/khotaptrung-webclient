{{--@extends('errors::minimal')--}}

{{--@section('title', __('Not Found'))--}}
@extends('frontend.layouts.master')

@section('content')
    <section>
        <div class="row marginauto justify-content-center">
            <div class="col-auto center">
                <img src="/assets/frontend/images/dog.png" alt="">
                <br>
                <br>
                <span>Trang không tồn tại. Vui lòng thử lại sau</span>
                <br>
                <br>
                <a class="loginBox__layma__button loginBox__layma__button404" href="/"><span>Về trang chủ</span></a>
            </div>
        </div>
    </section>
@endsection
{{--@section('code', '404')--}}
{{--@section('message', __('Not Found'))--}}
