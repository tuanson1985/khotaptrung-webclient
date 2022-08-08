<header id="heading">
    <nav class="heading">
        <div class="container c-container header-container">
            <div class="box-logo ">
                <a href="/">
                    <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/logo.png" alt="">
                </a>
            </div>
            <div class="d-none d-md-flex ">
                <div class="box-menu c-mr-16">
                    <div class="box-menu-bar  ">
                        <div class="box-icon brs-8 c-mr-8" >
                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/menu.svg" alt="" >
                        </div>
                        <span class="lh-40 box-icon-text fw-700">Danh mục</span>
                    </div>
{{--                    @if(!Request::is('/')) menu-category-height  @endif--}}

                    <div class="menu-list ">

                        @include('frontend.widget.__menu_category_desktop')

                    </div>
                </div>
                <div class="box-sale d-flex">
                    <div class="box-icon brs-8 c-mr-8" data-notity="5">
                        <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/sale.svg" alt="" >
                    </div>
                    <span class="lh-40 box-icon-text fw-700">Khuyến mãi</span>

                </div>
            </div>
            <div class="box-search d-none d-lg-block ">
                <form action="" class="form-search" style="width: 400px">
                    <input type="search" placeholder="Tìm kiếm" class=" has-submit">
                    <button type="submit"></button>
                </form>
            </div>
            <div  class="d-flex">
                <a class="btn primary c-px-34 c-mr-16 d-none d-lg-block " href="">Nạp thẻ</a>
                <div class="box-notify  d-flex ">
                    <div class="box-icon brs-8 " data-notity="5">
                        <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/ring.svg" alt="" >
                    </div>
                </div>
{{--                <div class="box-notify c-ml-24 d-none d-md-block ">--}}
{{--                    <div class="box-icon brs-8 ">--}}
{{--                        <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/profile.svg" alt="" >--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="box-account c-ml-16 d-none d-md-block position-relative">
                    <div class="box-loading btn-loading">
                        <div class="loading">
                            <div class="loading-child"></div>
                        </div>
                    </div>
                    <div class="account-logined box-account-open ">

                    </div>
                    <div class="box-account-logined position-absolute brs-12">

                        <div class="box-account-title d-flex justify-content-between c-mb-18">
                            <div class="fw-700 fz-20 lh-28 title-color">Tài khoản</div>
                            <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/profile_close.svg" alt="" class="close-login-popup c-mr-12">
                        </div>
                        <div class="c-pr-16 account-logined-content box-account_nologined">
                            <div class="login-popup brs-12 c-p-16 d-flex m-auto justify-content-between">
                                <div class="m-auto ">
                                    <img src="/assets/frontend/{{theme('')->theme_key}}/image/nam/login-robot.png" alt="">
                                </div>

                                <div class="login-popup_content c-ml-24">
                                    <div class="text-secondary-color fw-700 lh-28 fz-20">
                                        Nick.vn xin chào!
                                    </div>
                                    <div class="fw-400 c-mt-4">Vui lòng đăng nhập để sử dụng dịch vụ của chúng tôi</div>
                                    <button class="btn primary w-100 c-mt-12"  onclick="openLoginModal()">Đăng nhập</button>
                                    <div class="c-mt-10">Bạn chưa có tài khoản? <a href="#" onclick="openRegisterModal()" class="text-primary-color fw-500 underline" style="text-decoration: underline">Đăng ký</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="account-logined-content c-pr-4 box-account_logined">

{{--                            @include('frontend.widget.__menu_profile')--}}

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </nav>
</header>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
    @csrf
</form>
