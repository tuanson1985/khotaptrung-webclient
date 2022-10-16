@extends('frontend.layouts.master')
@section('seo_head')
    @include('frontend.widget.__seo_head',with(['data'=>$data]))
@endsection
@section('meta_robots')
    <meta name="robots" content="index,follow" />
@endsection
@section('content')
    @if(isset($data->params) && isset($data->params->article_type))
        {!! $data->params->article_type !!}
    @endif

    <div class="container container-fix">
        {{--breadcrum--}}
        <ul class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="/" class="breadcrumb-link">Trang chủ</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/tin-tuc" class="breadcrumb-link">Tin tức</a>
            </li>
            <li class="breadcrumb-item">
                <a href="" class="breadcrumb-link">Chi tiết tin tức</a>
            </li>
        </ul>
        <div class="head-mobile">
            <a href="/tin-tuc" class="link-back"></a>

            <h1 class="head-title text-title">Chi tiết tin tức</h1>

            <a href="/" class="home"></a>
        </div>
        {{--content--}}
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class=" --custom p-3 mb-3 content-detail">
                    <article id="article--detail">
                        <h3 class="article--title">
                            {{ @$data->title }}
                        </h3>
                        <div class="article--info">
                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/duong/time.svg"
                                 class="c-mr-6"><span>{{ formatDateTime($data->created_at) }}</span>
                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/duong/group.svg"
                                 class="c-mr-6 c-ml-6"><span>{{ @$data->author->username }}</span>
                        </div>
                        <div class="py-4">
                            <img src="{{ @$data->image }}" alt="" class="article--thumbnail__image py-3 w-100">
                        </div>
                        <div class="article--content pb-3">
                            <div class="article--content__text pb-2">
                                {!! @$data->content !!}
                            </div>
                        </div>
                    </article>
                </div>
            </div>

                @include('frontend.pages.article.widget.__ads__article__theme__5')

        </div>

        {{--        Cùng chủ đề--}}
        <div class="c-pb-24">
            @include('frontend.widget.__bai__viet__lien__quan')
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/assets/frontend/{{theme('')->theme_key}}/js/js_duong/style.js"></script>
@endsection
