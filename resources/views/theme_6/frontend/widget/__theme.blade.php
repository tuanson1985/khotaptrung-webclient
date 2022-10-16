
@if(isset(theme('')->theme_config->sys_background_image))
    @if(isset(theme('')->theme_config->sys_background_image) == 'sys_background_image_ver1')
        <style>
            .main-lay-out{
                background:{{setting('sys_theme_background_color')}} url({{setting('sys_theme_background_image')}});
                padding: 20px 0;
                background-size: cover;
            }
        </style>
    @else
        <style>
            .main-lay-out{
                background:{{setting('sys_theme_background_color')}};
                padding: 20px 0;
                background-size: cover;
            }
        </style>
    @endif
@else
    <style>
        .main-lay-out{
            background:#000 url(/assets/frontend/{{theme('')->theme_key}}/image/anhnen.png);
            padding: 20px 0;
            background-size: cover;
        }
    </style>
@endif
{{--nạp thẻ trang chủ--}}
@if(isset(theme('')->theme_config->sys_charge_home))
    @if(theme('')->theme_config->sys_charge_home == 'sys_charge_home_ver1')
        <style>
            .content-banner-card {
                flex-basis: 29%;
            }
            .content-banner-slide {
                flex-basis: 69%;
            }
        </style>
    @else
        <style>
            .content-banner-card {
                flex-basis: 0%;
            }
            .content-banner-slide {
                flex-basis: 100%;
            }
        </style>
    @endif
@else
    <style>
        .content-banner-card {
            flex-basis: 29%;
        }
        .content-banner-slide {
            flex-basis: 69%;
        }
    </style>
@endif

{{--màu nền --}}
@if(setting('sys_theme_color_primary'))
    <style>
        header .nav-bar{
            background-color: {{setting('sys_theme_color_primary')}};
            box-shadow: none;
        }
        .content-banner {
            background-color: {{setting('sys_theme_color_primary')}};

        }
        .content-items .container{
            background-color: {{setting('sys_theme_color_primary')}};
        }
        .content-advertise .container{
            background-color: {{setting('sys_theme_color_primary')}};
        }
        .content-video .container {
            background-color: {{setting('sys_theme_color_primary')}};

        }
        .nav-log-in a:hover, .nav-regist a:hover {
            background-color: {{setting('sys_theme_color_primary')}};
            opacity: .8;
        }
        .content-video .container {
            border: 1px solid #cccccc;
        }
    </style>
    <script>
        $( document ).ready(function() {

            $(document).on('scroll',function(){
                if($(window).width() > 1024){
                    if ($(this).scrollTop() > 100) {
                        $(".nav-bar-container").css("height","90px");
                        $(".nav-bar-category .nav li a").css("line-height","90px");
                        $("header .nav-bar").css("background-color","{{setting('sys_theme_color_primary')}}");
                        $("header .nav-bar").css("box-shadow","0 6px 12px rgb(0 0 0 / 18%)");
                        $(".nav-bar-brand").css("margin","14px");


                    } else {
                        $(".nav-bar-container").css("height","120px");
                        $(".nav-bar-category .nav li a").css("line-height","120px");
                        $(".nav-bar-brand").css("margin","20px 0");
                        $("header .nav-bar").css("background-color","{{setting('sys_theme_color_primary')}}");
                        $("header .nav-bar").css("box-shadow","none");

                    }
                }

            });
        });
    </script>
@else
    <script>
        $(document).on('scroll',function(){
            if($(window).width() > 1024){
                if ($(this).scrollTop() > 100) {
                    $(".nav-bar-container").css("height","90px");
                    $(".nav-bar-category .nav li a").css("line-height","90px");
                    $("header .nav-bar").css("background-color","white");
                    $("header .nav-bar").css("box-shadow","0 6px 12px rgb(0 0 0 / 18%)");
                    $(".nav-bar-brand").css("margin","14px");


                } else {
                    $(".nav-bar-container").css("height","120px");
                    $(".nav-bar-category .nav li a").css("line-height","120px");
                    $(".nav-bar-brand").css("margin","20px 0");
                    $("header .nav-bar").css("background-color","white");
                    $("header .nav-bar").css("box-shadow","none");

                }
            }

        });
    </script>
@endif
@if(setting('sys_theme_color_text'))
    <style>
        .nav-bar-category .nav li a{
            color: {{setting('sys_theme_color_text')}}
        }
        .content-items .items-title h2 {

            color: {{setting('sys_theme_color_text')}};
        }
        .game-list-description p {
                color: {{setting('sys_theme_color_text')}};
        }
        .nav-bar-category .nav li ul li a {
            color: white;
        }
        .oldPrice {
            color:  {{setting('sys_theme_color_text')}};

        }
        .content-advertise .container marquee p{
            color: {{setting('sys_theme_color_text')}};
        }
        .content-advertise .container{
            border: 1px solid {{setting('sys_theme_color_text')}};
        }


    </style>

@endif
