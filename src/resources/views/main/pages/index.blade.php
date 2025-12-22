@extends('main.layouts.index')

@section('css')

    <title>{{ $seo->meta_title }}</title>
    <meta name="description" content="{{ $seo->meta_description }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords }}" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="profile" />
    <meta property="og:title" content="{{ $seo->meta_title }}" />
    <meta property="og:description" content="{{ $seo->meta_description }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="{{ $seo->meta_title }}" />
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}" />
    <meta name="twitter:card" content="{{ asset('assets/images/logo.png') }}" />
    <meta name="twitter:label1" content="{{ $seo->meta_title }}" />
    <meta name="twitter:data1" content="{{ $seo->meta_description }}" />
    @if ($about && $about->image)
        <link rel="preload" as="image" fetchpriority="high" href="{{ $about->image_link }}" type="image/webp">
    @endif

    <link rel="preload" href="{{$video_poster}}" as="image" fetchpriority="high">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/purecounter.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/jquery.isotope.v3.0.2.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/owl.carousel.min.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/home.js') }}">

    <link rel="icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}"
        sizes="32x32" />
    <link rel="icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}" />
    @if (!$about->use_in_banner && count($banners) > 0)
        <link rel="preload" as="script" href="{{ asset('assets/js/home/banner_slider.js') }}">
        @foreach ($banners as $k => $v)
            @if ($k == 0)
                <link rel="preload" type="image/webp" fetchpriority="high" href="{{ $v->banner_image_link }}"
                    as="image">
                <link rel="preload" type="image/webp" fetchpriority="high" href="{{ $v->banner_mobile_image_link }}"
                    as="image">
            @endif
        @endforeach
    @endif

    {!! $seo->meta_header_script_nonce !!}
    {!! $seo->meta_header_no_script_nonce !!}

    @vite(['resources/css/owl.carousel.min.css', 'resources/css/owl.theme.default.min.css'])

    <style nonce="{{ csp_nonce() }}">
        .p-relative {
            position: relative;
        }

        .obj-cover {
            object-fit: cover;
        }

        .project-img-shape {
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 5px 10px 10px 2px #818181;
            border: 6px double #ddce79;
            border-style: double double none none;
        }

        .shapeee {
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .project_old {
            /* background: var(--theme-header-color); */
            background: #ffffff;
        }

        .project_old .sub-title,
        .project_old .section-title span {
            color: #183e62;
        }

        .project_old .projects2-filter li {
            color: #183e62;
        }

        .project_old .projects2-filter li.active {
            color: var(--theme-primary-color);
        }

        .project_old .projects2-con {
            left: 20px;
            /* top: 70px; */
            top: 15px;
            background-image: none;
            pointer-events: none;
        }

        .project_old p {
            color: #222;
            font-size: 16px;
            font-weight: 400;
            text-align: justify;
        }

        .project_old p img {
            height: 20px;
            display: inline;
            width: 20px;
            margin-top: -5px;
        }

        .project_old .projects2-wrap h3 a {
            color: var(--theme-primary-color);
        }

        .project_old .projects-overlay:before {
            /* background: #000;
                                                                                                                                                                                                                                                                                                                                                                                                                                            opacity: 0.1; */
            /* background-image: linear-gradient(to right,rgba(27,25,25,0.1) 30%,transparent 100%); */
            /* background-image: linear-gradient(to right,rgba(27,25,25,0.2) 60%,transparent 100%); */
            /* background-image: linear-gradient(to right,rgb(27 25 25 / 45%) 25%,transparent 100%); */
        }

        .project_old .projects2-wrap h3 {
            font-size: 25px;
            margin-bottom: 0px;
        }

        .testimonials .owl-theme .owl-nav {
            bottom: 10%;
            right: 0%;
        }

        .slider-fade .v-middle {
            position: relative;
            transform: none;
            top: 0;
            left: 0;
        }

        .header.slider-fade {
            min-height: 1px;
            height: auto;
            overflow: hidden;
            background: transparent !important;
        }

        .slider-fade .slider .owl-item,
        .slider-fade .owl-item {
            height: auto;
            position: relative;
        }

        .slider-fade .slider .item,
        .slider-fade .item {
            position: static;
            background-image: none !important;
        }

        .slider-fade .owl-carousel .owl-stage:after,
        #slider-area:after {
            content: none;
        }

        .h-300-cover {
            height: 300px;
            object-fit: cover;
        }

        .about .desc-ul p {
            text-align: justify;
        }

        @media screen and (max-width: 600px) {
            #slider-area img {
                opacity: 1;
            }
        }

        .duru-header {
            position: fixed;
        }

        .counter-main {
            font-size: 4rem;
            line-height: 60px;
            color: #bda588;
            -webkit-text-stroke: 1px var(--theme-primary-color);
            opacity: .8;
        }

        #slider-area {
            min-height: 644px;
        }

        @media screen and (max-width: 600px) {
            #slider-area {
                min-height: 350px;
            }
        }

        .grid-wrapper .grid-item{
            position: relative;
            /* padding: 15px; */
            display: flex;
            flex-direction: column;
            justify-content: end;
            border-radius: 5px;
            overflow: hidden;
            height: 100%;
        }

        .grid-wrapper .grid-item:hover a .img-overlay img{
            transform: scale(1.1);
            transition: all 0.7s ease;
        }

        .grid-wrapper .grid-item .img-content{
            color: white;
            position: relative;
            padding: 15px;
            background: #183E62;
            background: linear-gradient(0deg, rgba(24, 62, 98, 1) 4%, rgba(24, 62, 98, 0.4) 77%, rgba(24, 62, 98, 0) 100%);
        }

        .grid-wrapper .grid-item .img-content h3{
            color: white;
            font-weight: 600;
            line-height: 1.15em;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 0;
        }

        .grid-wrapper .grid-item .img-content h3 a{
            color: white;
        }

        .grid-wrapper .grid-item .img-content p{
            color: white;
            margin: 0;
            font-size: 16px;
            font-weight: 400;
            text-align: justify;
            font-style: italic;
        }

        .grid-wrapper .grid-item .img-overlay{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            /* z-index: -1; */
        }

        .grid-wrapper .grid-item .img-overlay::after {
            content: '';
            /* background-color: #183e6275; */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .grid-wrapper .grid-item .img-overlay img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .grid-ribbon{
            position: absolute;
            z-index: 2;
            top: 0;
            left: auto;
            right: 0;
            transform: rotate(90deg);
            width: 150px;
            overflow: hidden;
            height: 150px;
            transform: rotate(90deg);
            left: auto;
            right: 0;
        }

        .grid-ribbon-content{
            text-align: center;
            left: 0;
            width: 200%;
            transform: translateY(-50%) translateX(-50%) translateX(35px) rotate(-45deg);
            margin-top: 35px;
            font-size: 13px;
            line-height: 2;
            font-weight: 800;
            text-transform: uppercase;
            background: #000;
            color: #fff;
            margin-top: 35px;
            transform: translateY(-50%) translateX(-50%) translateX(35px) rotate(-45deg);
        }

        .grid-wrapper {
            display: grid;
            /* grid-gap: 10px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-auto-rows: 200px;
            grid-auto-flow: dense; */
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 350px;
            gap: 24px;
        }
        .grid-wrapper .wide {
            /* grid-column: span 2; */
            /* grid-column: span 1;
            grid-row: span 2; */
            grid-column: span 2;
        }
        .grid-wrapper .tall {
            /* grid-row: span 2; */
            /* grid-row: span 4; */
            /* grid-row: span 4;
            grid-column: span 2; */
            grid-row: span 2;
        }
        .grid-wrapper .big {
            grid-column: span 2;
            grid-row: span 2;
        }

        .grid-wrapper .leftover-1 {
            grid-column: span 3;
        }

        .grid-wrapper .leftover-3 {
            grid-column: span 1;
        }

        #award-area{
            background: var(--theme-footer-color);
        }

        #award-area .section-title{
            color: white;
        }

        #award-area .section-title span{
            color: #bda588;
        }

        #award-area .award-container{
            padding: 40px 5px;
            text-align: center;
        }

        #award-area .award-container img{
            object-fit: contain;
            margin: auto;
            height: 80px;
        }

        #award-area .award-container h5{
            margin: 0;
            color: #bda588;
            font-weight: 600;
        }

        #award-area .award-container h4{
            margin: 0;
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        #award-area .award-container p{
            margin: 0;
            color: #b0b9c1;
            font-size: 1rem;
            font-style: italic;
        }

        #award-area .owl-theme .owl-nav, #testimonials-area .owl-nav{
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            justify-content: space-between;
        }

        #award-area .owl-theme .owl-nav [class*=owl-]{
            color: #000 !important;
            background-color: #fff !important;
        }

        #testimonials-area .owl-nav [class*=owl-]{
            color: #000 !important;
            background-color: var(--theme-primary-color) !important;
        }

        #award-area .owl-theme .owl-nav .owl-prev, #testimonials-area .owl-nav .owl-prev{
            margin-left: -20px;
        }

        #award-area .owl-theme .owl-nav .owl-next, #testimonials-area .owl-nav .owl-next{
            margin-right: -20px;
        }

        #award-area .owl-theme .owl-dots .owl-dot span, #testimonials-area .owl-dots .owl-dot span{
            background: white;
        }

        #award-area .owl-theme .owl-dots .owl-dot.active span, #award-area .owl-theme .owl-dots .owl-dot:hover span, #testimonials-area .owl-dots .owl-dot.active span, #testimonials-area .owl-dots .owl-dot:hover span{
            background: #bda588;
        }

        .special-contact-section{
            margin-top: -2rem !important;
        }

        .process .wrap{
            margin-top: 0 !important;
        }

        .blog-home .item .cont{
            margin-bottom: 0px !important;
            background-image: none;
            background-color: #fff;
        }

        .blog-home .item{
            border-radius: 20px;
            border: 3px double var(--theme-primary-color);;
            border-style: double;
            overflow: hidden;
        }

        .blog-home .item .post-img img{
            border-radius: 0px !important;
            border: none !important;
        }

        @media screen and (max-width: 600px){
            .grid-wrapper .wide {
                /* grid-column: span 2; */
                grid-column: unset;
                grid-row: span 2;
            }
            .grid-wrapper .tall {
                /* grid-row: span 2; */
                /* grid-row: span 4; */
                grid-row: span 2;
                grid-column: unset;
            }
            .grid-wrapper .big {
                grid-column: unset;
                grid-row: span 2;
            }

            .grid-wrapper .grid-item{
                grid-column: span 3 !important;
                grid-row: unset !important;
            }
        }


    </style>
    @if ($about->use_in_banner)
        <style nonce="{{ csp_nonce() }}">
            .header-video-container:before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 7;
                pointer-events: all;
                background-image: none;
            }

            .header-video {
                /* top: -20px; */
                position: static;
                aspect-ratio: auto 640 / 360; */
                max-width: 100%;
                display: inline-block;
                width: 100vw !important;
                height: 100vh !important;
                object-fit: fill !important;
                object-position: bottom;
            }

            /* .duru-header .duru-logo img {
                visibility: hidden;
            } */

            .duru-header.scrolled.awake .duru-logo img {
                visibility: visible;
            }

            .header-video-container {
                /* position: static; */
                padding-bottom: 0;
                /* max-height: 100dvh; */
            }

            .header-video-overflow {
                overflow: hidden;
                width: 100%;
                /* height: 99.5dvh; */
                /* padding-bottom: 55.82%; */
                position: relative;
            }

            #ytplayer-mute img {
                object-fit: contain;
                width: 30px;
                height: 30px;
            }

            #ytplayer-mute {
                position: absolute;
                /* bottom: 70px; */
                bottom: 5%;
                left: 15px;
                z-index: 8;
            }

            .subject-div{
                margin-top: 0 !important;
            }

            #ytplayer-mute:hover {
                background-color: #bda588;
                opacity: 0.8;
            }

            .contact-img-wrapper{
                padding: 15px;
                position: relative;
            }

            .contact-img-wrapper img{
                width: 100%;
                height: 80dvh;
            }

            .contact-img-wrapper a{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                padding: 5px 10px;
                border-radius: 2px;
            }

            .clr-bg-about{
                background-color: var(--theme-hero-color);
                width: 80%;
                height: 100%;
                position: absolute;
                right: 0;
                top: 0;
                z-index: -1;
                border-radius: 10px;
            }

            .about-content-padding{
                padding-left: 20px;
                padding-right: 40px;
            }

            .sec-title{
                color: var(--theme-highlight-text-color);
            }

            @media screen and (max-width: 600px) {
                .header-video-overflow {
                    height: auto;
                }

                .header-video {
                    /* top: 0px; */
                    height: 50dvh !important;
                    /* object-fit: cover; */
                }

                #ytplayer-mute {
                    bottom: 15px;
                }

                .contact-img-wrapper img {
                    max-height: 100px;
                    object-fit: cover;
                    vertical-align: middle;
                    filter: blur(1.5px);
                }

                .clr-bg-about{
                    width: 100%;
                    /* margin-top: -30px; */
                }

                .about-content-padding{
                    padding: 0;
                }

                .about.section-padding{
                    padding-bottom: 1rem !important;
                    padding-top: 1rem !important;
                }

                .about.section-padding .py-5{
                    padding-top: 5rem !important;
                }

                #testimonials-area{
                    padding-top: 5rem !important;
                    padding-bottom: 2rem !important;
                }

                .special-contact-section {
                    padding-bottom: 5rem !important;
                }
                #award-area {
                    padding-top: 7rem !important;
                }
            }
        </style>

        {{-- video banner new --}}
        <style nonce="{{ csp_nonce() }}">
            .desktopVideo {
                display: block !important;
            }
            .fullscreen {
                height: 100%;
                overflow: hidden;
                width: 100%;
            }
            .video {
                display: block;
                left: 0px;
                overflow: hidden;
                padding-bottom: 100dvh;
                position: absolute;
                top: 50%;
                width: 100%;
                -webkit-transform-origin: 50% 0;
                transform-origin: 50% 0;
                -webkit-transform: translateY(-50%);
                transform: translateY(-50%);
            }
            .video .wrapper {
                display: block;
                height: 100%;
                left: 0px;
                overflow: hidden;
                position: absolute;
                bottom: 0%;
                width: 100%;
            }
            .video video {
                display: block;
                height: 100%;
                width: 100%;
                /* object-fit: fill; */
                object-fit: cover;
            }
            .video-wrapper {
                -webkit-font-smoothing: subpixel-antialiased;
                filter: blur(0);
                -webkit-filter: blur(0);
                perspective: 1000px;
                -webkit-perspective: 1000px;
                height: 100dvh;
                position: relative;
                transition: none;
            }
            .speaker-menu {
                position: absolute !important;
                bottom: 5%;
                left: 30px !important;
            }

            .speaker-menu a{
                cursor: pointer;
            }

            @media screen and (max-width: 600px) {
                .video{
                    padding-bottom: 50dvh;
                }
                .video video {
                    object-fit: fill
                }

                .video-wrapper{
                    height: 50dvh;
                }

                .speaker-menu{
                    display: none !important;
                }
            }
        </style>
    @endif

@stop

@section('content')

    <!-- Slider -->
    @if ($about->use_in_banner)
        <div class="video-wrapper">
            <div class="fullscreen desktopVideo">
                <div class="video">
                    <div class="wrapper">
                        <video
                            id="video1"
                            width="512"
                            height="512"
                            loop=""
                            playsinline=""
                            muted=""
                            preload="none"
                            poster="{{$video_poster}}"
                            autoplay=""
                        >
                            <source src="{{$video}}" type="video/webm">
                            <!--<source src="images/video-bg.webm" type="video/webm" />-->
                        </video>
                    </div>
                </div>
                <div class="speaker-menu" style="">
                    <a style="z-index: 999" id="clickunmuteBtn">
                        <img loading="lazy" alt="Maiaestates_ Best Builders In Bangalore" id="mutecase" src="{{asset('mute.png')}}" style="width: 25px; display: block;"></a>
                    <a style="z-index: 999" id="clickmuteBtn">
                        <img loading="lazy" alt="Top Developers In Bangalore
    " id="unmutecase" src="{{asset('unmute.png')}}" style="width: 25px; display: none;"></a>
                </div>
            </div>
        </div>
    @else
        @if (count($banners) > 0)
            <header id="slider-area" class="header slider-fade">
                <div class="owl-carousel owl-theme">
                    <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                    @foreach ($banners as $keys => $banners)
                        @if ($k == 0)
                            <div class="item bg-img text-left" data-overlay-dark="4"
                                data-background="{{ $banners->banner_image_link }}">
                                <div class="v-middle caption">
                                    <a aria-label="{{ $banners->banner_image_title }}"
                                        href="{{ $banners->button_link ? $banners->button_link : '#' }}">
                                        {{-- <img src="{{$banners->banner_image_link}}" alt="{{$banners->banner_image_alt}}" title="{{$banners->banner_image_title}}" fetchpriority="low"> --}}
                                        <picture>
                                            <source data-srcset="{{ $banners->banner_mobile_image_link }}"
                                                media="(max-width: 991px)">
                                            <source data-srcset="{{ $banners->banner_image_link }}"
                                                media="(max-width: 1200px)">
                                            {{-- <source data-srcset="{{ $banners->banner_image_link }}" class="lazyload"> --}}
                                            <img src="{{ $banners->banner_image_link }}"
                                                alt="{{ $banners->banner_image_alt }}" width="1256" height="644"
                                                title="{{ $banners->banner_image_title }}" fetchpriority="high"
                                                loading="eager">
                                        </picture>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="item bg-img text-left" data-overlay-dark="4"
                                data-background="{{ $banners->banner_image_link }}">
                                <div class="v-middle caption">
                                    <a aria-label="{{ $banners->banner_image_title }}"
                                        href="{{ $banners->button_link ? $banners->button_link : '#' }}">
                                        {{-- <img src="{{$banners->banner_image_link}}" alt="{{$banners->banner_image_alt}}" title="{{$banners->banner_image_title}}" fetchpriority="low"> --}}
                                        <picture>
                                            <source data-srcset="{{ $banners->banner_mobile_image_link }}"
                                                media="(max-width: 600px)" class="lazyload">
                                            <source data-srcset="{{ $banners->banner_image_link }}"
                                                media="(max-width: 1920px)" class="lazyload">
                                            <source data-srcset="{{ $banners->banner_image_link }}" class="lazyload">
                                            <img data-src="{{ $banners->banner_image_link }}"
                                                alt="{{ $banners->banner_image_alt }}" width="1256" height="644"
                                                title="{{ $banners->banner_image_title }}" class="lazyload">
                                        </picture>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="slide-num" id="snh-1"></div>
                <div class="slider__progress"><span></span></div>
            </header>
        @endif
    @endif
    <!-- About -->
    <h1 class="d-none">{{ $seo->page_keywords }}</h1>
    <h2 class="d-none">{{ $seo->page_keywords }}</h2>

    <!-- Counter -->
    @if (count($counters) > 0)
        <section class="about lets-talk hero-contact pt-4 pb-4">
            <div class="background bg-img bg-fixed" data-overlay-dark="6">
                <div class="container pt-5 pb-1">
                    <div class="row justify-content-center">
                        @if ($counterHeading)
                            {{-- <div class="col-md-4 mb-30 " data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light pb-0">{{$counterHeading->sub_heading}}</div>
                        </div> --}}
                            <div class="col-md-auto" data-animate-effect="fadeInUp">
                                <div class="sub-title border-bot-light pb-0 m-0">
                                    <div class="section-title sec-title text-center m-0">{!! $counterHeading->heading !!}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12" data-animate-effect="fadeInUp">
                            <div id="purecounter" class="states">
                                <ul class="align-items-center justify-content-between flex gap-2">
                                    @foreach ($counters as $counters)
                                        {{-- <li class="flex"> --}}
                                        <li class="col-md-4 col-sm-12 mx-0 p-2 text-center">
                                            <div class="numb valign justify-content-center">
                                                <div class="counter-main m-0"><span class="purecounter" style="color: #bda588"
                                                        data-purecounter-duration="1" data-purecounter-start="1000"
                                                        data-purecounter-end="{{ $counters->counter_number }}">0</span>
                                                    {{ $counters->counter_text }}</div>
                                            </div>
                                            <div class="text valign justify-content-center">
                                                <p>
                                                    {!! $counters->title !!}
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($about)
        <section class="about section-padding pt-6 pb-6">
            <div class="container p-relative py-5">
                <div class="clr-bg-about"></div>
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6 col-sm-12" data-animate-effect="fadeInUp">
                        @if ($about->image)
                            <div class="con">
                                {{-- @if (request()->header('User-Agent') && preg_match('/mobile/i', request()->header('User-Agent'))) --}}
                                <img src="{{ $about->image_link }}" fetchpriority="high" loading="eager" width="373"
                                    height="375" class="img-fluid shapeee" alt="">
                                {{-- @else --}}
                                {{-- <img data-src="{{ $about->image_link }}" width="373" height="375"
																																				fetchpriority="low" class="img-fluid shapeee lazyload" alt=""> --}}
                                {{-- @endif --}}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 about-content-padding" data-animate-effect="fadeInUp">
                        <div class="row">
                            <div class="col-md-auto" data-animate-effect="fadeInUp">
                                <div class="sub-title border-bot-light pb-0 mb-3">
                                    <div class="section-title m-0">{!! $about->heading !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="desc-ul">
                            {!! $about->description !!}
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- @if (!$about->use_in_banner)
        <section class="about section-padding">
            <div class="container">
                <header class="p-relative header-video2-container">
                    <iframe src="{{$about->video}}?autoplay=0&mute=0&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video2" width="560" height="315" frameborder="0"></iframe>
                </header>
            </div>
        </section>
    @endif --}}

    <!-- Projects 2 -->
    <div class="projects2 project_old subject-div pt-4 pb-6" id="callback-popup-trigger">
        <div class="container">
            <div class="row mb-4">
                @if ($projectHeading)
                    <div class="col-md-12" data-animate-effect="fadeInUp">
                        {{-- <div class="sub-title border-bot-light pb-0">{{$projectHeading->sub_heading}}</div> --}}
                        <div class="sub-title border-bot-light pb-0 m-0 mb-3">
                            <div class="section-title m-0 text-center">{!! $projectHeading->heading !!}</div>
                        </div>
                    </div>
                @endif
                <div class="col-md-12" data-animate-effect="fadeInUp">
                    @if ($projectHeading)
                        <p>{!! $projectHeading->description !!}</p>
                    @endif
                    <div class="more w-100 d-flex justify-content-end"><a aria-label="All Projects" href="{{route('projects.get')}}" class="link-btn" tabindex="0" id="home_page_all_projects_button">Explore More</a></div>
                    {{-- <div class="row" data-animate-effect="fadeInUp" style="--bs-gutter-x: 0rem;">
                        <ul id="projects2-filter" class="projects2-filter text-center">
                            <li class="active" data-filter=".ongoing">Ongoing Projects</li>
                            <li data-filter=".completed">Completed Projects</li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="grid-wrapper">
                @foreach ($display_projects->chunk(5) as $group)

                    @foreach ($group->values() as $k => $v)
                    @php
                        $remainder = count($group->values()) % 5;

                        $isTall = $k === 1 && $remainder === 0;
                    @endphp
                        @if($remainder === 0)
                            <div
                            @class([
                                'tall' => $isTall,
                                'grid-item'
                            ])>
                                <a
                                aria-label="{{ $v->name }}"
                                class="w-100 h-100"
                                id="home_page_project_{{$k+1}}_button"
                                href="{{ route($v->is_completed == true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug) }}">
                                <div class="img-overlay">
                                    <img data-src="{{ $v->home_image_link }}" class="lazyload" alt="{{ $v->name }}" />
                                </div>
                                <div class="grid-ribbon">
                                    <div class="grid-ribbon-content">
                                        {{ $v->is_completed == true ? 'COMPLETED' : 'ONGOING' }}
                                    </div>
                                </div>
                                <div class="img-content">
                                    <h3><a aria-label="{{ $v->name }}"
                                            href="{{ route($v->is_completed == true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug) }}">{{ $v->name }}</a>
                                    </h3>
                                    <p>{{ $v->location }}</p>
                                </div>
                                </a>
                            </div>
                        @else
                            @if($group->count() === 1 || $group->count() === 3)
                            <div
                            @class([
                                'grid-item',
                                'leftover-'.$group->count()
                            ])>
                                <a
                                aria-label="{{ $v->name }}"
                                class="w-100 h-100"
                                id="home_page_project_{{$k+1}}_button"
                                href="{{ route($v->is_completed == true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug) }}">
                                <div class="img-overlay">
                                    <img data-src="{{ $v->home_image_link }}" class="lazyload" alt="{{ $v->name }}" />
                                </div>
                                <div class="grid-ribbon">
                                    <div class="grid-ribbon-content">
                                        {{ $v->is_completed == true ? 'COMPLETED' : 'ONGOING' }}
                                    </div>
                                </div>
                                <div class="img-content">
                                    <h3><a aria-label="{{ $v->name }}"
                                            href="{{ route($v->is_completed == true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug) }}">{{ $v->name }}</a>
                                    </h3>
                                    <p>{{ $v->location }}</p>
                                </div>
                                </a>
                            </div>
                            @else
                                @foreach($v->chunk(2) as $key => $grp)
                                    @foreach($v->values() as $ke => $va)
                                    <div
                                    @class([
                                        'wide' => ($key===0 && $ke===0) || ($key===1 && $ke===1),
                                        'grid-item',
                                    ])>
                                        <a
                                        aria-label="{{ $v->name }}"
                                        class="w-100 h-100"
                                        id="home_page_project_{{$k+1}}_button"
                                        href="{{ route($v->is_completed == true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug) }}">
                                        <div class="img-overlay">
                                            <img data-src="{{ $v->home_image_link }}" class="lazyload" alt="{{ $v->name }}" />
                                        </div>
                                        <div class="grid-ribbon">
                                            <div class="grid-ribbon-content">
                                                {{ $v->is_completed == true ? 'COMPLETED' : 'ONGOING' }}
                                            </div>
                                        </div>
                                        <div class="img-content">
                                            <h3><a aria-label="{{ $v->name }}"
                                                    href="{{ route($v->is_completed == true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug) }}">{{ $v->name }}</a>
                                            </h3>
                                            <p>{{ $v->location }}</p>
                                        </div>
                                        </a>
                                    </div>
                                    @endforeach
                                @endforeach
                            @endif
                        @endif
                @endforeach
                @endforeach


            </div>

        </div>
    </div>

    <!-- AWARDS -->
    @if (count($awards) > 0)
        <section id="award-area" class="testimonials pt-6 pb-6 mt-5">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-auto">
                        <div class="sub-title border-bot-light pb-0">
                            <div class="section-title text-center m-0">Accolades Our creations have won many hearts.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="wrap">
                            <div class="owl-carousel owl-theme">

                                @foreach ($awards as $award)
                                    <div class="award-container">
                                        <img data-src="{{asset('assets/crown.webp')}}" alt="{!! $award->title !!}" class="lazyload">
                                        <h5>
                                            {{ $award->year}}
                                        </h5>
                                        <h4>
                                            {!! $award->title !!}</h4>
                                        <p>{{$award->sub_title}}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <!-- Testiominals -->
    @if (count($testimonials) > 0)
        <section id="testimonials-area" class="testimonials pt-4 pb-2">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-auto">
                        @if ($testimonialHeading)
                            <div class="sub-title border-bot-light pb-0">
                                <div class="section-title text-center m-0 mb-3">{!! $testimonialHeading->heading !!}</div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <div class="wrap">
                            <div id="vdo-play-btn" class="owl-carousel owl-theme">

                                @foreach ($testimonials as $k =>$testimonials)
                                    <div class="row">
                                        <div class="col-md-12" data-animate-effect="fadeInUp">
                                            <div class="vid-area mb-30">
                                                <iframe id="yt_iframe_{{ $testimonials->id }}" loading="lazy"
                                                    src="" class="w-100 yt_iframe d-none" height="350"
                                                    title="{{ $testimonials->video_title }}" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    frameborder="0"></iframe>
                                                <div class="vid-icon"> <img
                                                        data-src="https://i3.ytimg.com/vi/{{ $testimonials->video_id }}/maxresdefault.jpg"
                                                        width="573" height="322" alt="YouTube"
                                                        class="lazyload">
                                                    <button class="video-gallery-button vid vdo-play-btn"
                                                        aria-label="{{ $testimonials->video_title }}"
                                                        data-iframe="yt_iframe_{{ $testimonials->id }}"
                                                        id="home_page_testimonial_{{$k+1}}_button"
                                                        data-href="{{ $testimonials->video }}"> <span
                                                            class="video-gallery-polygon">
                                                            <i class="ti-control-play"></i>
                                                        </span> </button>
                                                </div>
                                                <h3 class="testimonial-name sub-title">
                                                    {{ $testimonials->video_title }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Blog -->
    @if (count($blogs) > 0)
        <section class="blog-home suffix-div mt-0 pt-5 pb-3 mb-5">
            <div class="container py-5">
                <div class="row justify-content-center">
                    {{-- <div class="col-md-4">
                        <div class="sub-title border-bot-light pb-0">Blog</div>
                    </div> --}}
                    <div class="col-md-auto">
                        <div class="sub-title border-bot-light pb-0 m-0">
                            <div class="section-title text-center m-0 mb-4"><span>Latest News</span></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($blogs as $k => $v)
                        <div class="col-md-4">
                            <div class="item mb-5">
                                <div class="post-img">
                                    <a aria-label="{{ $v->name }}"
                                        id="home_page_blog_image_{{$k+1}}_button"
                                        target="_blank" href="{{ route('blogs_detail.get', $v->slug) }}">
                                        <div class="img"> <img data-src="{{ $v->image_link }}" class="lazyload"
                                                width="361" height="237" alt="" fetchpriority="low"> </div>
                                    </a>
                                </div>
                                <div class="cont">
                                    <h4><a aria-label="{{ $v->name }}"
                                            id="home_page_blog_name_{{$k+1}}_button"
                                            target="_blank" href="{{ route('blogs_detail.get', $v->slug) }}">{{ $v->name }}</a></h4>
                                    <p class="m-0">{{ Str::limit($v->description_unfiltered, 200) }}</p>
                                    <div class="date mt-2"><a aria-label="{{ $v->name }}"
                                            id="home_page_blog_time_{{$k+1}}_button"
                                            target="_blank" href="{{ route('blogs_detail.get', $v->slug) }}"><span
                                                class="ti-time"></span>&nbsp;&nbsp;<span>{{ $v->created_at->format('M d, Y h:i A') }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- @include('main.includes.referal') --}}

    <section class="blog-home special-contact-section mt-0 pt-0 pb-5">
        <div class="container-fluid py-5">
            <div class="row mb-2 justify-content-center">
                <div class="col-md-auto">
                    <div class="sub-title border-bot-light pb-0 m-0 mb-3">
                        <div class="section-title text-center m-0"><span>GET IN TOUCH</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="contact-img-wrapper">
                        <img data-src="{{asset('assets/referral_contact.png')}}" class="lazyload" alt="CLIENTS">
                        <a href="{{route('referal_page.get')}}" id="home_page_referral_button">REFERRAL</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="contact-img-wrapper">
                        <img data-src="{{asset('assets/channel_partner_contact.png')}}" class="lazyload" alt="CHANNEL PARTNER">
                        <a href="{{route('channel_partner.get')}}" id="home_page_channel_partner_button">CHANNEL PARTNER</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="contact-img-wrapper">
                        <img data-src="{{asset('assets/land_owner_contact.png')}}" class="lazyload" alt="LAND OWNER">
                        <a href="{{route('land_owner.get')}}" id="home_page_land_owner_button">LAND OWNER</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="contact-img-wrapper">
                        <img data-src="{{asset('assets/career_contact.png')}}" class="lazyload" alt="CAREER">
                        <a href="{{route('career_page.get')}}" id="home_page_career_button">CAREER</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact_modal')

@stop

@section('js')
    <script src="{{ asset('assets/js/plugins/purecounter.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/jquery.isotope.v3.0.2.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/owl.carousel.min.js') }}" defer></script>
    @if (!$about->use_in_banner && count($banners) > 0)
        <script src="{{ asset('assets/js/home/banner_slider.js') }}" defer></script>
    @endif
    <script src="{{ asset('assets/js/home.js') }}?v=v2" defer></script>

    {!! $seo->meta_footer_script_nonce !!}
    {!! $seo->meta_footer_no_script_nonce !!}

    @include('main.includes.common_contact_modal_script')

    {{-- <script type="text/javascript" nonce="{{ csp_nonce() }}" defer>
        const source = document.getElementById('ytplayer_src');
        const isMobile = window.innerWidth <= 768;

        source.src = isMobile ? "{{ asset('home_mobile.mp4') }}" : "{{ asset('home_desktop.mp4') }}";
        document.getElementById('ytplayer').load();
    </script> --}}

@stop
