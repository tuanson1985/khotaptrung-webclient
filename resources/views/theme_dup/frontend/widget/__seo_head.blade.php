@if(Request::is('tin-tuc'))
    <title>Tin tức</title>
@elseif(Request::is('mua-acc'))
    <title>Mua acc all game uy tín, giá rẻ. Giao dịch nick tự động 100%. Tài khoản lỗi hoàn tiền 1 - 1</title>
@elseif(isset($data) && (isset($data->custom->slug) || isset($data->slug)))
    @if(Request::is('mua-acc/'. (!isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug) .''))
        <title>{{ isset($data->custom->seo_title) ? $data->custom->seo_title :  $data->seo_title }}</title>
    @elseif(Request::is('dich-vu/'. $data->slug .''))
        <title>{{ $data->seo_title??'' }}</title>
    @elseif(Request::is('tin-tuc/'. $data->slug .''))
        <title>{{ $data->seo_title??'' }}</title>
    @endif
@elseif(Request::is('dich-vu'))
    <title>Shop dịch vụ all game giá rẻ, uy tín, tự động.</title>
@elseif(isset($data->randId))
    @if(Request::is('acc/'. $data->randId .''))
        <title>{{ isset($data->category->custom->seo_title) ? $data->category->custom->title :  $data->category->seo_title??'' }} mã số {{ $data->randId??'' }}</title>
    @endif
@elseif(Request::is('mua-the'))
    <title>{{setting('sys_store_card_title')??setting('sys_title') }}</title>
@elseif(isset($datacard))
    <title>Mua thẻ {{ $datacard }}</title>
@elseif(isset($datakey) && isset($dataname))
    <title>Mua thẻ {{ $dataname }} mệnh giá {{ $datakey }}</title>
@elseif(isset($title->title))
    @if(isset($data->randId))
    @else
        <title>{{$title->title }}</title>
    @endif
@elseif(isset($data->title))
    @if(isset($data->randId))
    @else
        <title>{{$data->title }}</title>
    @endif
@else
    <title>  {{setting('sys_title') }}</title>
@endif

@if(Request::is('tin-tuc'))
    <meta name="description" content="Tin tức">
    <meta property="og:description" content="Tin tức"/>
@elseif(Request::is('mua-acc'))
    <meta name="description" content="Shop bán acc all game: Free Fire, Liên Quân, Liên Minh, PUBG Mobile, Tốc Chiến, Ngọc Rồng, Ninja,.. uy tín, giá rẻ. Giao dịch nick tự động 24/7. Tài khoản lỗi hoàn tiền 100%. Website phục vụ 100.000 giao dịch thành công mỗi ngày cho khách hàng cả nước.">
    <meta property="og:description" content="Shop bán acc all game: Free Fire, Liên Quân, Liên Minh, PUBG Mobile, Tốc Chiến, Ngọc Rồng, Ninja,.. uy tín, giá rẻ. Giao dịch nick tự động 24/7. Tài khoản lỗi hoàn tiền 100%. Website phục vụ 100.000 giao dịch thành công mỗi ngày cho khách hàng cả nước."/>
@elseif(isset($data) && (isset($data->custom->slug) || isset($data->slug)))
    @if(Request::is('mua-acc/'. (!isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug) .''))

        <meta name="description" content="{{ isset($data->custom->seo_description) ? $data->custom->seo_description :  $data->seo_description }}">
        <meta property="og:description" content="{{ isset($data->custom->seo_description) ? $data->custom->seo_description :  $data->seo_description }}"/>
    @elseif(Request::is('dich-vu/'. $data->slug .''))
        <meta name="description" content="{{ $data->seo_description??'' }}">
        <meta property="og:description" content="{{ $data->seo_description??'' }}"/>
    @elseif(Request::is('tin-tuc/'. $data->slug .''))
        <meta name="description" content="{{ $data->seo_description??'' }}">
        <meta property="og:description" content="{{ $data->seo_description??'' }}"/>
    @endif
@elseif(isset($data->randId))
    @if(Request::is('acc/'. $data->randId .''))

        <meta name="description" content="{{ isset($data->category->custom->seo_title) ? $data->category->custom->title :  $data->category->seo_title??'' }} mã số {{ $data->randId??'' }}">
        <meta property="og:description" content="{{ isset($data->category->custom->seo_title) ? $data->category->custom->title :  $data->category->seo_title??'' }} mã số {{ $data->randId??'' }}"/>

    @endif
@elseif(Request::is('dich-vu'))
    <meta name="description" content="Website cung cấp các dịch vụ như: nạp game ( kim cương, quân huy, RP, UC, vàng, ngọc, xu... ), cày thuê ( liên quân, liên minh, free fire, ... ), làm nhiệm vụ thuê, ...">
    <meta property="og:description" content="Website cung cấp các dịch vụ như: nạp game ( kim cương, quân huy, RP, UC, vàng, ngọc, xu... ), cày thuê ( liên quân, liên minh, free fire, ... ), làm nhiệm vụ thuê, ..."/>
@elseif(Request::is('mua-the'))
    <meta name="description" content="{{ strip_tags(setting('sys_store_card_seo')??setting('sys_description')) }}">
    <meta property="og:description" content="{{ strip_tags(setting('sys_store_card_seo')??setting('sys_description')) }}"/>
@elseif(isset($datacard))
    <meta name="description" content="Mua thẻ {{ $datacard }}">
    <meta property="og:description" content="Mua thẻ {{ $datacard }}"/>
@elseif(isset($datakey) && isset($dataname))
    <meta name="description" content="Mua thẻ {{ $dataname }} mệnh giá {{ $datakey }}">
    <meta property="og:description" content="Mua thẻ {{ $dataname }} mệnh giá {{ $datakey }}"/>
@elseif(isset($title->seo_description))
    <meta name="description" content="{{ $title->seo_description??'' }}">
    <meta property="og:description" content="{{ $title->seo_description??'' }}"/>
@elseif(isset($data->seo_description))
    <meta name="description" content="{{ $data->seo_description??'' }}">
    <meta property="og:description" content="{{ $data->seo_description??'' }}"/>
@else
    <meta name="description" content="{{ setting('sys_description') }}">
    <meta property="og:description" content="{{ setting('sys_description') }}"/>
@endif

@if(isset($data->randId))
    @if(Request::is('acc/'. $data->randId .''))
        <title>{{ isset($data->category->custom->seo_title) ? $data->category->custom->title :  $data->category->seo_title??'' }} mã số {{ $data->randId??'' }}</title>
        <meta property="og:title" content="{{ isset($data->category->custom->seo_title) ? $data->category->custom->seo_title :  $data->category->seo_title }} mã số {{ $data->randId }}">
        <meta name="description" content="{{ isset($data->category->custom->seo_title) ? $data->category->custom->title :  $data->category->seo_title??'' }} mã số {{ $data->randId??'' }}">
        <meta property="og:description" content="{{ isset($data->category->custom->seo_title) ? $data->category->custom->title :  $data->category->seo_title??'' }} mã số {{ $data->randId??'' }}"/>
    @endif
@elseif(Request::is('mua-acc'))
    <meta property="og:title" content="Mua acc all game uy tín, giá rẻ. Giao dịch nick tự động 100%. Tài khoản lỗi hoàn tiền 1 - 1">
@elseif(isset($data) && (isset($data->custom->slug) || isset($data->slug)))
    @if(Request::is('mua-acc/'. (!isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug) .''))
        <meta property="og:title" content="{{ isset($data->custom->seo_title) ? $data->custom->seo_title :  $data->seo_title }}">
    @elseif(Request::is('dich-vu/'. $data->slug .''))
        <meta property="og:title" content="{{ $data->title??'' }}">
    @elseif(Request::is('tin-tuc/'. $data->slug .''))
        <meta property="og:title" content="{{ $data->seo_title??'' }}">
    @endif
@elseif(Request::is('dich-vu'))
    <meta property="og:title" content="Shop dịch vụ all game giá rẻ, uy tín, tự động.">
@elseif(Request::is('mua-the'))
    <meta property="og:title" content="{{setting('sys_store_card_title')??setting('sys_title') }}">
@elseif(isset($datacard))
    <meta property="og:title" content="Mua thẻ {{ $datacard }}">
@elseif(isset($datakey) && isset($dataname))
    <meta property="og:title" content="Mua thẻ {{ $dataname }} mệnh giá {{ $datakey }}">
@elseif(isset($title->title))
    @if(isset($data->randId))
    @else
        <meta property="og:title" content="{{$title->title}}">
    @endif
@elseif(isset($data->title))
    @if(isset($data->randId))
    @else
        <meta property="og:title" content="{{$data->title}}">
    @endif
@else
    <meta property="og:title" content="{{setting('sys_title')}}">
@endif

@if(isset($data->image))
    <meta property="og:image" content="{{\App\Library\MediaHelpers::media($data->image)}}">
@elseif ( setting('sys_og_image') && setting('sys_og_image') != "")
    <meta property="og:image" content="{{\App\Library\MediaHelpers::media(setting('sys_og_image'))}}">
@else
    <meta property="og:image" content="{{\App\Library\MediaHelpers::media(setting('sys_logo'))}}">
@endif
<meta name="keywords" content="{{setting('sys_keyword')}}">
<link rel="shortcut icon" href="{{\App\Library\MediaHelpers::media(setting('sys_favicon'))}}" type="image/x-icon">
<meta property="og:url" content="{{url()->current()}}"/>
<link rel="canonical" href="{{ url()->current() }}">
{{--@if(Request::is('mua-the'))--}}
{{--    <title>{{setting('sys_store_card_title')??setting('sys_title') }}</title>--}}
{{--    <meta name="description" content="{{ strip_tags(setting('sys_store_card_seo')??setting('sys_description')) }}">--}}
{{--@else--}}
{{--    <title>{{$data->title??setting('sys_title') }}</title>--}}
{{--    <meta name="description" content="{{ strip_tags($data->description??setting('sys_description')) }}">--}}
{{--@endif--}}

@if(isset($data) && (isset($data->custom->slug) || isset($data->slug)))
    @if(Request::is('mua-acc/'. (!isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug) .''))
        <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "{{\Request::server ("HTTP_HOST")}}",
            "item": "https://{{\Request::server ("HTTP_HOST")}}/mua-acc"
          },{
            "@type": "ListItem",
            "position": 2,
            "name": "✅(Đã xác minh uy tín)",
            "item": "https://https://{{\Request::server ("HTTP_HOST")}}/mua-acc/{{ !isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug }}"
          }]
        }
    </script>

        <script type="application/ld+json">
    {
          "@graph":
      [
          {
                "@context": "http://schema.org/",
                "@type": "Product",
                "name": "{{ isset($data->custom->seo_title) ? $data->custom->seo_title :  $data->seo_title }}",
                    "description": "{{ isset($data->custom->seo_description) ? $data->custom->seo_description :  $data->seo_description }}",
                     "image": "{{ isset($data->custom->image) ? $data->custom->image :  $data->image }}",
                    "brand": {
                        "@type": "Brand",
                        "name": "{{\Request::server ("HTTP_HOST")}}"
                      },
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "5",
                        "bestRating": "5",
                        "worstRating": "4",
                        "ratingCount": "79396",
                        "reviewCount": "793986"
                    },
                    "sku": "{{ !isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug }}",
                    "gtin8": "{{ !isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug }}",
                    "mpn": "{{ !isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug }}",
                    "offers": {
                            "@type": "Offer",
                             "url": "https://{{\Request::server ("HTTP_HOST")}}/mua-acc/{{ !isset($data->custom->slug) || $data->custom->slug == "" ? $data->slug :  $data->custom->slug }}",
                            "priceCurrency": "VND",
                            "price": "7700",
                            "priceValidUntil": "2099-12-31",
                            "availability": "https://schema.org/InStock",
                            "itemCondition": "https://schema.org/NewCondition"
                          },
                    "review": {
                    "@type": "Review",
                    "name": "{{ isset($data->custom->seo_title) ? $data->custom->seo_title :  $data->seo_title }}",
                    "reviewBody": "{{ isset($data->custom->seo_description) ? $data->custom->seo_description :  $data->seo_description }}",
                    "reviewRating": {
                      "@type": "Rating",
                      "ratingValue": "5",
                      "bestRating": "5",
                      "worstRating": "4"
                    },
                    "author": {"@type": "Person", "name": "An"},
                    "publisher": {"@type": "Organization", "name": "An"}
                  }
          },
        {
          "@context": "http://schema.org",
          "@type": "WebSite",
          "name": "https://{{\Request::server ("HTTP_HOST")}}",
              "url": "https://{{\Request::server ("HTTP_HOST")}}"
        }
      ]
    }
    </script>

    @elseif(Request::is('dich-vu/'. $data->slug .''))
        <script type="application/ld+json">
            {
              "@context": "https://schema.org/",
              "@type": "BreadcrumbList",
              "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "{{\Request::server ("HTTP_HOST")}}",
                "item": "https://{{\Request::server ("HTTP_HOST")}}/dich-vu/"
              },{
                "@type": "ListItem",
                "position": 2,
                "name": "✅(Đã xác minh uy tín)",
                "item": "https://{{\Request::server ("HTTP_HOST")}}/dich-vu/{{ $data->slug }}"
              }]
            }
            </script>
        <script type="application/ld+json">
    {
          "@graph":
      [
          {
                "@context": "http://schema.org/",
                "@type": "Product",
                "name": "{{ $data->title??'' }}",
                    "description": "Hệ thống bán RP liên minh giá rẻ. Đảm bảo RP sạch 100%.Mọi giao dịch đều có ảnh hóa đơn của GARENA gửi cho quý khách. Ngoài cách nạp RP - LOL ( Liên Minh ) trực tiếp, các bạn có thể mua thẻ Garena giá rẻ với chiết khấu lên đến 5% tại đây.",
                     "image": "{{ $data->image??'' }}",
                    "brand": {
                        "@type": "Brand",
                        "name": "webnick"
                      },
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "5",
                        "bestRating": "5",
                        "worstRating": "4",
                        "ratingCount": "79396",
                        "reviewCount": "793986"
                    },
                    "sku": "{{ $data->slug??'' }}",
                    "gtin8": "{{ $data->slug??'' }}",
                    "mpn": "{{ $data->slug??'' }}",
                    "offers": {
                            "@type": "Offer",
                             "url": "https://{{\Request::server ("HTTP_HOST")}}/dich-vu/",
                            "priceCurrency": "VND",
                            "price": "7700",
                            "priceValidUntil": "2099-12-31",
                            "availability": "https://schema.org/InStock",
                            "itemCondition": "https://schema.org/NewCondition"
                          },
                    "review": {
                    "@type": "Review",
                    "name": "{{ $data->title??'' }}",
                    "reviewBody": "{{ $data->seo_description??'' }}",
                    "reviewRating": {
                      "@type": "Rating",
                      "ratingValue": "5",
                      "bestRating": "5",
                      "worstRating": "4"
                    },
                    "author": {"@type": "Person", "name": "An"},
                    "publisher": {"@type": "Organization", "name": "An"}
                  }
          },
        {
          "@context": "http://schema.org",
          "@type": "WebSite",
          "name": "{{\Request::server ("HTTP_HOST")}}",
              "url": "https://{{\Request::server ("HTTP_HOST")}}/"
        }
      ]
    }
    </script>
    @elseif(Request::is('tin-tuc/'. $data->slug .''))

        <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Tin tức",
            "item": "https://{{\Request::server ("HTTP_HOST")}}/tin-tuc/"
          },{
            "@type": "ListItem",
            "position": 2,
            "name": "{{ $data->title??'' }}",
            "item": "https://{{\Request::server ("HTTP_HOST")}}/tin-tuc/{{ $data->slug }}"
          }]
        }
        </script>
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Article",
              "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://{{\Request::server ("HTTP_HOST")}}/tin-tuc/{{ $data->slug }}"
              },
              "headline": "{{ $data->title??'' }}",
              "image": "{{\App\Library\MediaHelpers::media($data->image)}}",
              "author": {
                "@type": "",
                "name": "{{ $data->author->username }}"
              },
              "publisher": {
                "@type": "Organization",
                "name": "{{\Request::server ("HTTP_HOST")}}",
                "logo": {
                  "@type": "ImageObject",
                  "url": "{{\App\Library\MediaHelpers::media(setting('sys_logo'))}}"
                }
              },
              @if(setting('sys_zip_shop') && setting('sys_zip_shop') != '')
                "datePublished": "{{ formatDateTime($data->published_at) }}"
              @else
                "datePublished": "{{ formatDateTime($data->created_at) }}"
              @endif
            }
        </script>

        @if(isset($data) && isset($data->params_plus))
            @php
                $question = json_decode($data->params_plus);
                $first_question = null;
                $first_answer = null;
                $second_question = null;
                $second_answer = null;
                $three_question = null;
                $three_answer = null;
                $foor_question = null;
                $foor_answer = null;

                if (isset($question)){
                    if (isset($question->first)){
                        $first = json_decode($question->first);
                        $first_question = $first->first_question;
                        $first_answer = $first->first_answer;

                    }
                    if (isset($question->second)){
                        $second = json_decode($question->second);
                        $second_question = $second->second_question;
                        $second_answer = $second->second_answer;

                    }
                    if (isset($question->three)){
                        $three = json_decode($question->three);
                        $three_question = $three->three_question;
                        $three_answer = $three->three_answer;

                    }

                    if (isset($question->foor)){
                        $foor = json_decode($question->foor);
                        $foor_question = $foor->foor_question;
                        $foor_answer = $foor->foor_answer;

                    }
                }
            @endphp

            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [{
                    "@type": "Question",
                    "name": "{{ $first_question??'' }}",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "{{ $first_answer??'' }}"
                    }
                },
                {
                    "@type": "Question",
                    "name": "{{ $second_question??'' }}",
                    "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $second_answer??'' }}"
                    }
                },{
                    "@type": "Question",
                    "name": "{{ $three_question??'' }}",
                    "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $three_answer??'' }}"
                    }
                },{
                    "@type": "Question",
                    "name": "{{ $foor_question??'' }}",
                    "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $foor_answer??'' }}"
                    }
                }]}
            </script>
        @endif
    @elseif(Request::is('blog/'. $data->slug .''))

        <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Blog",
            "item": "https://{{\Request::server ("HTTP_HOST")}}/blog/"
          },{
            "@type": "ListItem",
            "position": 2,
            "name": "{{ $data->title??'' }}",
            "item": "https://{{\Request::server ("HTTP_HOST")}}/blog/{{ $data->slug }}"
          }]
        }
        </script>
        <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "Article",
              "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://{{\Request::server ("HTTP_HOST")}}/blog/{{ $data->slug }}"
              },
              "headline": "{{ $data->title??'' }}",
              "image": "{{\App\Library\MediaHelpers::media($data->image)}}",
              "author": {
                "@type": "",
                "name": "{{ $data->author->username??'' }}"
              },
              "publisher": {
                "@type": "Organization",
                "name": "{{\Request::server ("HTTP_HOST")}}",
                "logo": {
                  "@type": "ImageObject",
                  "url": "{{\App\Library\MediaHelpers::media(setting('sys_logo'))}}"
                }
              },
              @if(setting('sys_zip_shop') && setting('sys_zip_shop') != '')
                "datePublished": "{{ formatDateTime($data->published_at) }}"
              @else
                "datePublished": "{{ formatDateTime($data->created_at) }}"
              @endif
            }
        </script>

        @if(isset($data) && isset($data->params_plus))
            @php
                $question = json_decode($data->params_plus);
                $first_question = null;
                $first_answer = null;
                $second_question = null;
                $second_answer = null;
                $three_question = null;
                $three_answer = null;
                $foor_question = null;
                $foor_answer = null;

                if (isset($question)){
                    if (isset($question->first)){
                        $first = json_decode($question->first);
                        $first_question = $first->first_question;
                        $first_answer = $first->first_answer;

                    }
                    if (isset($question->second)){
                        $second = json_decode($question->second);
                        $second_question = $second->second_question;
                        $second_answer = $second->second_answer;

                    }
                    if (isset($question->three)){
                        $three = json_decode($question->three);
                        $three_question = $three->three_question;
                        $three_answer = $three->three_answer;

                    }

                    if (isset($question->foor)){
                        $foor = json_decode($question->foor);
                        $foor_question = $foor->foor_question;
                        $foor_answer = $foor->foor_answer;

                    }
                }
            @endphp

            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [{
                    "@type": "Question",
                    "name": "{{ $first_question??'' }}",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "{{ $first_answer??'' }}"
                    }
                },
                {
                    "@type": "Question",
                    "name": "{{ $second_question??'' }}",
                    "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $second_answer??'' }}"
                    }
                },{
                    "@type": "Question",
                    "name": "{{ $three_question??'' }}",
                    "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $three_answer??'' }}"
                    }
                },{
                    "@type": "Question",
                    "name": "{{ $foor_question??'' }}",
                    "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $foor_answer??'' }}"
                    }
                }]}
            </script>
        @endif
    @endif

@elseif(setting('sys_schema') != '')
    {!! setting('sys_schema') !!}
@endif
